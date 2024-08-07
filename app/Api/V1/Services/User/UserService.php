<?php

namespace App\Api\V1\Services\User;

use App\Admin\Repositories\Driver\DriverRepositoryInterface;
use App\Admin\Repositories\Nany\NanyRepositoryInterface;
use App\Admin\Services\File\FileService;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Admin\Traits\Setup;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    use Setup;
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    protected $nanyRepository;
    protected $driverRepository;

    protected FileService $fileService;

    public function __construct(
        UserRepositoryInterface $repository,
        FileService $fileService,
        NanyRepositoryInterface $nanyRepository,
        DriverRepositoryInterface $driverRepository
    ) {
        $this->repository = $repository;
        $this->nanyRepository = $nanyRepository;
        $this->driverRepository = $driverRepository;
        $this->fileService = $fileService;
    }

    public function store(Request $request)
    {
        $this->data = $request->validated();
        $this->data['username'] = $this->data['phone'];
        $this->data['code'] = $this->createCodeUser();
        // $this->data['roles'] = UserRoles::Member();
        $this->data['vip'] = UserVip::Default();
        // $this->data['gender'] = Gender::Male();
        $this->data['password'] = bcrypt($this->data['password']);
        return $this->repository->create($this->data);
    }

    public function update(Request $request)
    {
        $this->data = $request->validated();

        if (isset($this->data['password']) && $this->data['password']) {
            $this->data['password'] = bcrypt($this->data['password']);
        } else {
            unset($this->data['password']);
        }
        $user = Auth::user();
        if (isset($this->data['avatar'])) {
            $avatar = $this->data['avatar'];
            $this->data['avatar'] = $this->fileService->uploadAvatar('images', $avatar, $user->avatar);
        }

        return $this->repository->update($user->id, $this->data);
    }

    public function updateParent(Request $request)
    {
        $this->data = $request->validated();
        $user = Auth::user();
        if (isset($this->data['avatar'])) {
            $avatar = $this->data['avatar'];
            $this->data['avatar'] = $this->fileService->uploadAvatar('images/parents', $avatar, $user->avatar);
        }
        if(isset($this->data['phone'])){
            $this->data['username'] = $this->data['phone'];
        }
        return $this->repository->update($user->id, $this->data);
    }

    public function updateNany(Request $request)
    {
        $this->data = $request->validated();
        $user = Auth::user();
        $nany = $this->nanyRepository->findByField('user_id', $user->id);
        if (isset($this->data['avatar'])) {
            $avatar = $this->data['avatar'];
            $this->data['avatar'] = $this->fileService->uploadAvatar('images/nannies', $avatar, $user->avatar);
        }
        if (isset($this->data['id_card_front'])) {
            $idCardFront = $this->data['id_card_front'];
            $this->data['id_card_front'] = $this->fileService->uploadAvatar('images/nannies', $idCardFront, $nany->id_card_front);
        }
        if (isset($this->data['id_card_back'])) {
            $idCardBack = $this->data['id_card_back'];
            $this->data['id_card_back'] = $this->fileService->uploadAvatar('images/nannies', $idCardBack, $nany->id_card_back);
        }

        $this->nanyRepository->update($nany->id, $this->data);
        if(isset($this->data['phone'])){
            $this->data['username'] = $this->data['phone'];
        }
        return $this->repository->update($user->id, $this->data);
    }

    public function updateDriver(Request $request)
    {
        $this->data = $request->validated();
        $user = Auth::user();
        $driver = $this->driverRepository->findByField('user_id', $user->id);
        if (isset($this->data['avatar'])) {
            $avatar = $this->data['avatar'];
            $this->data['avatar'] = $this->fileService->uploadAvatar('images/drivers', $avatar, $user->avatar);
        }
        if (isset($this->data['id_card_front'])) {
            $idCardFront = $this->data['id_card_front'];
            $this->data['id_card_front'] = $this->fileService->uploadAvatar('images/drivers', $idCardFront, $driver->id_card_front);
        }
        if (isset($this->data['id_card_back'])) {
            $idCardBack = $this->data['id_card_back'];
            $this->data['id_card_back'] = $this->fileService->uploadAvatar('images/drivers', $idCardBack, $driver->id_card_back);
        }

        $this->driverRepository->update($driver->id, $this->data);
        if(isset($this->data['phone'])){
            $this->data['username'] = $this->data['phone'];
        }
        return $this->repository->update($user->id, $this->data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
