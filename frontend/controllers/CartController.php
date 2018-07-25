<?php

namespace frontend\controllers;


use domain\entities\cart\Order;
use domain\entities\cart\OrderItem;
use domain\entities\Product;
use yz\shoppingcart\ShoppingCart;

class CartController extends DefaultController
{
    public function actionAdd($id)
    {

        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->put($product);
            if(\Yii::$app->request->isAjax) {
                return $this->actionList();
            }
            return $this->goBack();
        }
    }

    public function actionList()
    {
        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        $products = $cart->getPositions();
        $total = $cart->getCost();

        if(\Yii::$app->request->isAjax) {
            return $this->renderAjax('list', [
                'products' => $products,
                'total' => $total,
            ]);
        }
        
        return $this->render('list', [
           'products' => $products,
           'total' => $total,
        ]);
    }

    public function actionRemove($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->remove($product);
            $this->redirect(['cart/list']);
        }
    }

    public function actionUpdate($id, $quantity)
    {
        $product = Product::findOne($id);
        if ($product) {
            \Yii::$app->cart->update($product, $quantity);
            $this->redirect(['cart/list']);
        }
    }

    public function actionOrder()
    {
        $order = new Order();

        /* @var $cart ShoppingCart */
        $cart = \Yii::$app->cart;

        /* @var $products Product[] */
        $products = $cart->getPositions();
        $total = $cart->getCost();

        if ($order->load(\Yii::$app->request->post()) && $order->validate()) {
            $transaction = $order->getDb()->beginTransaction();
            $order->save(false);

            foreach($products as $product) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->title = $product->title;
                $orderItem->price = $product->getPrice();
                $orderItem->product_id = $product->id;
                $orderItem->quantity = $product->getQuantity();
                if (!$orderItem->save(false)) {
                    $transaction->rollBack();
                    \Yii::$app->session->addFlash('error', 'Ошибка з обработкой заказа. Пожалуйста свяжитесь с нами.');
                    return $this->redirect('catalog/list');
                }
            }

            $transaction->commit();
            \Yii::$app->cart->removeAll();

            \Yii::$app->session->addFlash('success', 'Спасибо за Ваш заказ. Мы скоро с Вами свяжемся.');
            $order->sendEmail();

            return $this->redirect(['catalog/list']);
        }

        return $this->render('order', [
            'order' => $order,
            'products' => $products,
            'total' => $total,
        ]);
    }
}
