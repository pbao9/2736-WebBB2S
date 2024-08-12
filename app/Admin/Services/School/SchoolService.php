<?php

namespace App\Admin\Services\School;

use App\Admin\Repositories\School\SchoolRepositoryInterface;
use App\Imports\SchoolImport;
use App\Traits\UseLog;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class SchoolService implements SchoolServiceInterface
{
    use UseLog;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected array $data;
    
    protected SchoolRepositoryInterface $repository;

    public function __construct(SchoolRepositoryInterface $repository){
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function store(Request $request){

        $data = $request->validated();
		return $this->repository->create($data);
    }

    public function update(Request $request): object
    {
        
        $data = $request->validated();

        return $this->repository->update($data['id'], $data);

    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function import($file)
    {
        if ($file->isValid()) {
            try {
                Excel::import(new SchoolImport, $file);
                return ['success' => true, 'message' => __('uploadSuccess')];
            } catch (ValidationException $e) {
                $failures = $e->failures();
                $errorMessages = [];
                foreach ($failures as $failure) {
                    $errorMessages[] = $failure->errors();
                }
                return ['success' => false, 'message' => 'Nhập file thất bại, kiểm tra lại!'];
            } catch (\Exception $e) {
                return ['success' => false, 'message' => 'Kiểm tra lại: ' . $e->getMessage()];
            }
        } else {
            return ['success' => false, 'message' => __('uploadFail')];
        }
    }

}