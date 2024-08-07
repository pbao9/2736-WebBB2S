<?php

namespace App\Api\V1\Services\User;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    /**
     * Tạo mới
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function store(Request $request);
    /**
     * Cập nhật
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return boolean
     */
    public function update(Request $request);
    /**
     * Cập nhật phụ huynh
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return boolean
     */
    public function updateParent(Request $request);
    /**
     * Cập nhật Giám sinh
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return boolean
     */
    public function updateNany(Request $request);
    /**
     * Cập nhật tài xế
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return boolean
     */
    public function updateDriver(Request $request);
    /**
     * Xóa
     *  
     * @param int $id
     * 
     * @return boolean
     */
    public function delete($id);

}