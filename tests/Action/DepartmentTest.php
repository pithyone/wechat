<?php
/**
 * DepartmentTest.php.
 *
 * @author  wangbing <pithyone@vip.qq.com>
 * @date    2017/8/31
 */

namespace pithyone\wechat\tests\Action;

use pithyone\wechat\Action\Department;
use pithyone\wechat\tests\AbstractTestCase;

/**
 * Class DepartmentTest.
 */
class DepartmentTest extends AbstractTestCase
{
    public function testCreate()
    {
        $body = '{"errcode":0,"errmsg":"created","id":2}';
        $work = $this->getWork($body);

        $json = '{"name":"广州研发中心","parentid":1,"order":1,"id":2}';
        $data = json_decode($json, true);
        $res = $work->department->create($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Department::DEPARTMENT_CREATE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testUpdate()
    {
        $body = '{"errcode":0,"errmsg":"updated"}';
        $work = $this->getWork($body);

        $json = '{"id":2,"name":"广州研发中心","parentid":1,"order":1}';
        $data = json_decode($json, true);
        $res = $work->department->update($data);

        $this->assertEquals('POST', $res['method']);
        $this->assertEquals(Department::DEPARTMENT_UPDATE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($data, $res['options']['json']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function testDelete()
    {
        $body = '{"errcode":0,"errmsg":"deleted"}';
        $work = $this->getWork($body);

        $id = 2;
        $res = $work->department->delete($id);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Department::DEPARTMENT_DELETE, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($id, $res['options']['query']['id']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }

    public function lists()
    {
        $body = '{"errcode":0,"errmsg":"ok","department":[{"id":2,"name":"广州研发中心","parentid":1,"order":10},{"id":"3","name":"邮箱产品部","parentid":2,"order":40}]}';
        $work = $this->getWork($body);

        $id = 1;
        $res = $work->department->lists($id);

        $this->assertEquals('GET', $res['method']);
        $this->assertEquals(Department::DEPARTMENT_LIST, $res['uri']);
        $this->assertEquals(self::ACCESS_TOKEN, $res['options']['query']['access_token']);
        $this->assertEquals($id, $res['options']['query']['id']);
        $this->assertArraySubset(json_decode($body, true), $res);
    }
}
