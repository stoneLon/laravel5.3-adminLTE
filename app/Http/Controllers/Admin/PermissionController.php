<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PermissionStoreForm;
use App\Http\Requests\Admin\PermissionUpdateForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ilongx\Repositories\PermissionRepository;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * 列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $list = $this->permissionRepository->paginate(20);
        return view('admin.permission.index', compact('list'));
    }

    /**
     * 新增页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * 修改页面
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->findOrFail($id);
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * 新增操作
     *
     * @param PermissionStoreForm $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionStoreForm $request)
    {
        $data = $request->only(['permission_name', 'location', 'route', 'status']);
        $data = array_filter($data, 'delEmpty');
        $this->permissionRepository->create($data);
        return redirect()->route('admin.permission.index')->with('success', '权限添加成功');
    }

    /**
     *更新操作
     *
     * @param PermissionUpdateForm $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PermissionUpdateForm $request)
    {
        $data = $request->only(['permission_name', 'location', 'route']);
        $this->permissionRepository->update($data, $request->permission_id, 'permission_id');
        return redirect()->route('admin.permission.index')->with('success', '权限修改成功');
    }

    /**
     * 删除操作
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $role = $this->permissionRepository->findOrFail($request->id);
        $role->delete();
        return responseJson(2, '删除成功', ['id' => $request->id]);
    }
}
