<?php

namespace app\controllers;

use app\models\Product;
use yii\Query;
use yii\base\BaseObject;
use yii\web\Controller;


/**
 * Class A
 *
 * @package app\controllers
 * @property int $prop
 */
class A extends BaseObject
{
    private $prop;

    public function getProp()
    {
        return $this->prop;
    }

    public function setProp($value)
    {
        return $this->prop = $value;
    }
}


/**
 * Class TestController
 * @package app\controllers
 */
class TestController extends Controller
{
    public function actionIndex()
    {
//        $obj = new A();
//        $obj->prop = 11;
//        var_dump($obj->prop); exit();
//
//        $model = new Product();
//        $model->id = 1;
//        $model->name = 'Good';
//        $model->price = 123;
//
//        return $this->render('index', [
//            'var' => 'Hello World!'
//        ]);
//        return \Yii::$app->test->run();
//
//        $model = new Product();
//        $model->setAttributes(['id' => 1, 'name' => 'pear', 'price' => 70]);
//
//        return VarDumper::dumpAsString($model->safeAttributes());
//
//        $id = 5;
//
//        $queryUser = (new Query())->from('user')->select('id')-> limit (1);
//        $query = (new Query())->from('product')->where(['id' => $queryUser]);
//        $query = (new Query())->from('product')->select(['idUser' => 'id']);
//
//        $result = $query->all();
//
//        return $this->render('index', [
//            'result' => $result
//        ]);

//        $model = new User();
//        $model = User::findOne(2);
//        $model->username = 'Second';
//        $model->name = 'Второй';
//        $model->password_hash = '23232443dfdsf';
//        $model->created_at = time();
//        $model->creator_id = 'fdgf';
//        $model->save();
        $model = User::findOne(3);
//        $models = User::find()where(['id' => 1])->one();
        $result = $model->sharedTasks;
        return $this->render('index', [
            'result' => $result
        ]);
    }

    public function actionInsert()
    {
        $result = \Yii::$app->db->createCommand()->insert('user', [
            'username' => 'root',
            'name' => 'Artem',
            'password_hash' => 1234,
            'access_token' => '58e19cd2f980f32aa1cadcc14a33dd0e218a48fd',
            'auth_key' => 1,
            'creator_id' => 341,
            'updater_id' => 42,
            'creator_at' => 124,
            'updater_at' => 452,
        ])->execute();


        $result = \Yii::$app->db->createCommand()->batchInsert('task', ['creator_id', 'id'],
            [
                [1, 1],
                [2, 2],
                [3, 3],

            ])->execute();

        return $this->render('index', [
            'result' => $result

        ]);

        return VarDumper::dumpAsString($result);
    }

    public function actionSelect()
    {
        $id = 1;
        $query = (new Query())->from('user')->select(['id'])->where(['=', 'id', $id]);
        $result = $query->one;
        $query = (new Query())->from('user')->select(['id'])->where(['>', 'id', $id])->orderBy('name');
        $result = $query->all;
        $query = (new Query())->from('user')->count('*');
        $result = $query->all;
        $query = (new Query())->from('task')->select(['creator_id'])->innerJoin('user', 'task');
        $result = $query->all;


        return VarDumper::dumpAsString($result);


    }
}

