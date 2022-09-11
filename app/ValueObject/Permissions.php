<?php

namespace App\ValueObject;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

class Permissions implements Arrayable
{
    private bool $canCreate;
    private bool $canUpdate;
    private bool $canView;
    private bool $canViewAny;
    private bool $canDelete;

    public function __construct(Model $model, User $user)
    {
        $this->canCreate = $user->can('create', $model);
        $this->canUpdate = $user->can('update', $model);
        $this->canView = $user->can('view', $model);
        $this->canViewAny = $user->can('viewAny', $model);
        $this->canDelete = $user->can('delete', $model);
    }

    public function toArray(): array
    {
        return [
            'create' => $this->canCreate,
            'update' => $this->canCreate,
            'view' => $this->canCreate,
            'viewAny' => $this->canCreate,
            'delete' => $this->canCreate,
        ];
    }
}
