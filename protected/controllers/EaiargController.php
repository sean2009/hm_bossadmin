<?php

class EaiArgController extends AdminController {

    //系统参数
    public function actionIndex() {
        $list = ArgModel::model()->findAll(array(
            'condition' => 'is_deleted = 0 ',
        ));
        $render['list'] = $list;

        $cateList = array();
        $_cateList = ArgCategoryModel::model()->findAll(array(
            'condition' => 'is_deleted = 0 ',
        ));

        foreach ((array) $_cateList as $key => $val) {
            $_data[$val['cate_id']]['info'] = $val;
            $_data[$val['cate_id']]['list'] = array();
            $parents[$val['parent_id']][$val['cate_id']] = true;
        }

        $cateList = $this->findChildren($parents, 0, $_data);
        $render['cateList'] = $cateList['list'];

        $logData = array(
            'opter_action' => 'arglist',
            'opter_name' => Yii::app()->adminuser->admin_name,
            'opter_admin_id' => Yii::app()->adminuser->admin_id,
            'content' => '查看系统参数',
        );
        LogWebService::setLogs($logData);
        $this->render('arg_list', $render);
    }

    //系统参数-修改/添加
    public function actionArgAdd() {
        $arg_id = !empty($_REQUEST['arg_id']) ? $_REQUEST['arg_id'] : '';
        if ($arg_id) {
            $info = ArgModel::model()->find("arg_id = $arg_id");
            $render['info'] = $info;
        }
        $cateList = array();
        $_cateList = ArgCategoryModel::model()->findAll(array(
            'condition' => 'is_deleted = 0 ',
        ));

        foreach ((array) $_cateList as $key => $val) {
            $_data[$val['cate_id']]['info'] = $val;
            $_data[$val['cate_id']]['list'] = array();
            $parents[$val['parent_id']][$val['cate_id']] = true;
        }

        $cateList = $this->findChildren($parents, 0, $_data);
        $render['cateList'] = $cateList['list'];

        $this->render('arg_add', $render);
    }

    private function findChildren($parents, $parent_id, $_data) {
        if (isset($_data[$parent_id])) {
            $v = $_data[$parent_id];
        } else {
            $v = array();
        }
        if (is_array($parents[$parent_id])) {
            foreach ($parents[$parent_id] as $key => $val) {
                $child[$key] = $this->findChildren($parents, $key, $_data);
            }
            $v['list'] = $child;
        }
        return $v;
    }

    //分类-结果
    function _cateToTree($list = array(), $parent_id = 0) {
        $return = array();
        if (!empty($list)) {
            foreach ((array) $list as $key => $value) {
                if ($parent_id == $value['parent_id']) {
                    $return[$value['cate_id']]['info'] = $value;
                    $return[$value['cate_id']]['list'] = $this->_cateToTree($list, $value['cate_id']);
                }
            }
        }
        return $return;
    }

    //系统参数-删除
    public function actionArgDel() {
        $admin_id = Yii::app()->adminuser->admin_id;
        $arg_id = !empty($_REQUEST['arg_id']) ? $_REQUEST['arg_id'] : '';
        if (empty($arg_id) || empty($admin_id)) {
            return false;
        }
        $Model = new ArgModel;
        //修改保存
        $updata = array(
            'is_deleted' => 1,
            'edit_admin_id' => $admin_id,
            'edit_date' => new CDbExpression('NOW()'),
        );
        $rs = $Model->updateByPk($arg_id, $updata);

        if ($rs == true) {
            $logData = array(
                'opter_action' => 'arglist',
                'opter_name' => Yii::app()->adminuser->admin_name,
                'opter_admin_id' => Yii::app()->adminuser->admin_id,
                'content' => '删除系统参数成功',
            );
            LogWebService::setLogs($logData);
            // echo "删除成功";
        } else {
            $logData = array(
                'opter_action' => 'arglist',
                'opter_name' => Yii::app()->adminuser->admin_name,
                'opter_admin_id' => Yii::app()->adminuser->admin_id,
                'content' => '删除系统参数失败',
            );
            LogWebService::setLogs($logData);
            // echo "删除失败";
            throw new CHttpException(500, "删除失败");
        }
        $this->redirect(array('arglist'));
        exit;
    }

    //取参数值
    public function actionArgGetRowByCode() {
        $code = !empty($_REQUEST['code']) ? trim($_REQUEST['code']) : '';
        $admin_id = Yii::app()->adminuser->admin_id;
        if (empty($code) || empty($admin_id)) {
            return false;
        }
        $info = ArgModel::model()->find(array(
            'select' => 'arg_id,arg_code,arg_remark,arg_value',
            'condition' => ' arg_code = :arg_code ',
            'params' => array(':arg_code' => $code),
        ));
        $json = new CJSON();
        echo $data = $json->encode($info);
        exit;
    }

    //取参数值
    public function actionAjaxByArgID() {
        $arg_id = !empty($_REQUEST['arg_id']) ? trim($_REQUEST['arg_id']) : '';
        $admin_id = Yii::app()->adminuser->admin_id;
        if (empty($arg_id) || empty($admin_id)) {
            return false;
        }
        $info = ArgModel::model()->find(array(
            'select' => 'arg_id,arg_code,arg_remark,arg_value,cate_id',
            'condition' => ' arg_id = :arg_id ',
            'params' => array(':arg_id' => $arg_id),
            'order' => ' arg_id desc ',
        ));
        $json = new CJSON();
        echo $data = $json->encode($info);
        exit;
    }

    //取参数分类文章列表
    public function actionAjaxArgListByCateID() {
        $cate_id = !empty($_REQUEST['cate_id']) ? trim($_REQUEST['cate_id']) : '';
        $admin_id = Yii::app()->adminuser->admin_id;
        if (empty($cate_id) || empty($admin_id)) {
            return false;
        }
        $list = ArgModel::model()->findAll(array(
            'select' => 'arg_id,arg_code,arg_remark,arg_value,cate_id',
            'condition' => ' cate_id = :cate_id ',
            'params' => array(':cate_id' => $cate_id),
            'order' => ' arg_id desc ',
        ));
        $json = new CJSON();
        echo $data = $json->encode($list);
        exit;
    }

    //系统参数-保存
    public function actionArgSave() {
        $admin_id = Yii::app()->adminuser->admin_id;
        if (empty($admin_id)) {
            return false;
        }
        $data = array();
        $data['arg_id'] = !empty($_POST['arg_id']) ? $_POST['arg_id'] : '';
        $data['arg_code'] = trim($_POST['arg_code']);
        $data['cate_id'] = trim($_POST['cate_id']);
        $data['arg_remark'] = trim($_POST['arg_remark']);
        $data['arg_value'] = trim($_POST['arg_value']);
        $data['admin_id'] = $admin_id;
        $data['ajax'] = !empty($_POST['ajax']) ? $_POST['ajax'] : 0;
        if (empty($data['arg_code'])) {
            //echo "请输入参数名称";
            throw new CHttpException(500, "请输入参数名称");
            exit;
        }
        if (empty($data['cate_id'])) {
            //echo "请选择参数分类";
            throw new CHttpException(500, "请选择参数分类");
            exit;
        }
        if (empty($data['arg_value'])) {
            //echo "请输入参数值";
            throw new CHttpException(500, "请输入参数值");
            exit;
        }

        $Model = new ArgModel;
        if (!empty($data['arg_id'])) {

            $info = $Model->find(array(
                'select' => 'arg_code',
                'condition' => ' arg_code = :arg_code and arg_id != :arg_id ',
                'params' => array(':arg_code' => $data['arg_code'], ':arg_id' => $data['arg_id']),
            ));
            if (!empty($info)) {
                throw new CHttpException(500, "输入参数名称已经存在");
                // echo "输入标识码已经存在";
            }
            //修改保存
            $updata = array(
                'arg_code' => $data['arg_code'],
                'cate_id' => $data['cate_id'],
                'arg_remark' => $data['arg_remark'],
                'arg_value' => $data['arg_value'],
                'edit_admin_id' => $data['admin_id'],
                'edit_date' => new CDbExpression('NOW()'),
            );
            $rs = $Model->updateByPk($data['arg_id'], $updata);
            $logData = array(
                'opter_action' => 'arglist',
                'opter_name' => Yii::app()->adminuser->admin_name,
                'opter_admin_id' => Yii::app()->adminuser->admin_id,
                'content' => '修改系统参数成功',
            );
            LogWebService::setLogs($logData);
        } else {
            $info = $Model->find(array(
                'select' => 'arg_code',
                'condition' => ' arg_code = :arg_code ',
                'params' => array(':arg_code' => $data['arg_code']),
            ));
            if (!empty($info)) {
                // echo "输入标识码已经存在";
                throw new CHttpException(500, "输入参数名称已经存在");
            }
            //新增保存
            $Model->arg_code = $data['arg_code'];
            $Model->cate_id = $data['cate_id'];
            $Model->arg_remark = $data['arg_remark'];
            $Model->arg_value = $data['arg_value'];
            $Model->add_admin_id = $data['admin_id'];
            $Model->add_date = new CDbExpression('NOW()');
            $rs = $Model->save();
            $logData = array(
                'opter_action' => 'arglist',
                'opter_name' => Yii::app()->adminuser->admin_name,
                'opter_admin_id' => Yii::app()->adminuser->admin_id,
                'content' => '新增系统参数成功',
            );
            LogWebService::setLogs($logData);
        }

        if ($rs == true) {
            //echo "保存成功";
        } else {
            //echo "保存失败";
            throw new CHttpException(500, "保存失败");
        }
        if (empty($data['ajax'])) {
            $this->redirect(array('index'));
        } else {
            echo $rs;
        }

        exit;
    }

    //系统参数分类-列表
    public function actionArgCateList() {
        $parent_id = !empty($_REQUEST['parent_id']) ? $_REQUEST['parent_id'] : 0;

        $_cateList = ArgCategoryModel::model()->findAll(array(
            'condition' => 'is_deleted = 0 ',
        ));

        foreach ((array) $_cateList as $key => $value) {
            if ($value['parent_id'] == $parent_id) {
                $cateList[$value['cate_id']]['info'] = $value;
            }

            if ($value['parent_id'] > 0) {
                $cateList[$value['parent_id']]['list'][$value['cate_id']]['info'] = $value;
                $cateList[$value['parent_id']]['list'][$value['cate_id']]['list'] = $this->_cateToTree($_cateList, $value['cate_id']);
            }
        }


        foreach ((array) $cateList as $key => $value) {
            if (empty($value['info'])) {
                unset($cateList[$key]);
            }
        }
        if ($parent_id) {
            $parent = ArgCategoryModel::model()->find("cate_id = $parent_id");
            $render ['parent'] = $parent;
            $render ['parent_id'] = $parent_id;
        }

        $render['list'] = $cateList;
        $logData = array(
            'opter_action' => 'argcatelist',
            'opter_name' => Yii::app()->adminuser->admin_name,
            'opter_admin_id' => Yii::app()->adminuser->admin_id,
            'content' => '查看系统参数分类',
        );
        LogWebService::setLogs($logData);
        $this->render('arg_cate_list', $render);
    }

    //参数分类-新增
    public function actionArgCateAdd() {
        $parent_id = !empty($_REQUEST['parent_id']) ? $_REQUEST['parent_id'] : '';
        if ($parent_id) {
            $parent = ArgCategoryModel::model()->find("cate_id = $parent_id");
            $render ['parent'] = $parent;
            $render ['parent_id'] = $parent_id;
        }
        $this->render('arg_cate_edit', $render);
    }

    //参数分类-编辑
    public function actionArgCateEdit() {
        $id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
        if ($id) {
            $info = ArgCategoryModel::model()->find("cate_id = $id");
            $render ['info'] = $info;
            $render ['parent_id'] = $info['parent_id'];
        }

        $this->render('arg_cate_edit', $render);
    }

    //系统分类-保存
    public function actionArgCateSave() {
        $admin_id = Yii::app()->adminuser->admin_id;
        $data = array();
        $data['cate_id'] = !empty($_POST['cate_id']) ? $_POST['cate_id'] : '';
        $data['cate_name'] = trim($_POST['cate_name']);
        $data['parent_id'] = !empty($_POST['parent_id']) ? $_POST['parent_id'] : 0;
        $data['admin_id'] = $admin_id;
        if (empty($data['cate_name'])) {
            // echo "请输入分类名称";
            throw new CHttpException(500, "请输入参数分类名称");
        }

        if (strlen($data['cate_name']) > 299) {
            // echo "请输入分类名称";
            throw new CHttpException(500, "您输入参数分类名称太长");
        }

        $Model = new ArgCategoryModel;

        if (!empty($data['cate_id'])) {
            $info = $Model->find(array(
                'select' => 'cate_name',
                'condition' => ' cate_name = :cate_name and cate_id = :cate_id ',
                'params' => array(':cate_name' => $data['cate_name'], ':cate_id' => $data['cate_id']),
            ));
            if (!empty($info)) {
                throw new CHttpException(500, "输入参数分类名称已经存在");
                // echo "输入标识码已经存在";
            }

            //修改保存
            $updata = array(
                'cate_name' => $data['cate_name'],
                'parent_id' => $data['parent_id'],
                'edit_admin_id' => $data['admin_id'],
                'edit_date' => new CDbExpression('NOW()'),
            );
            $rs = $Model->updateByPk($data['cate_id'], $updata);

            $logData = array(
                'opter_action' => 'argcatelist',
                'opter_name' => Yii::app()->adminuser->admin_name,
                'opter_admin_id' => Yii::app()->adminuser->admin_id,
                'content' => '修改参数分类成功',
            );
            LogWebService::setLogs($logData);
        } else {

            $info = $Model->find(array(
                'select' => 'cate_name',
                'condition' => ' cate_name = :cate_name ',
                'params' => array(':cate_name' => $data['cate_name']),
            ));
            if (!empty($info)) {
                throw new CHttpException(500, "输入分类名称已经存在");
            }
            //新增保存
            $Model->cate_name = $data['cate_name'];
            $Model->parent_id = $data['parent_id'];
            $Model->add_admin_id = $data['admin_id'];
            $Model->add_date = new CDbExpression('NOW()');

            $rs = $Model->save();
            $logData = array(
                'opter_action' => 'argcatelist',
                'opter_name' => Yii::app()->adminuser->admin_name,
                'opter_admin_id' => Yii::app()->adminuser->admin_id,
                'content' => '新增参数分类成功',
            );
            LogWebService::setLogs($logData);
        }

        if ($rs == true) {
            //echo "保存成功";
        } else {
            throw new CHttpException(500, "保存失败");
            // echo "保存失败";
        }
        $this->redirect(array('eaiarg/ArgCateList', array('parent_id' => $data['parent_id'])));
        exit;
    }

    public function actionArgApi() {
        $params['argcode'] = !empty($_REQUEST['argcode']) ? $_REQUEST['argcode'] : '';
        ;
        $rs = LogWebService::getArgs($params);
        echo json_encode($rs);
    }

}
