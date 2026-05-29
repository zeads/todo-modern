<?php

namespace App\Repositories;

use App\Models\Todo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TodoRepository
{
    public function paginateWithFilter(
        array $filters,
    ): LengthAwarePaginator
    {
        $query = Todo::query();
        if(!empty($filters['search'])) {
            $query->where(
                'title',
                'like',
                '%' . $filters['search'] . '%',
            );
        }

        // if($filters['status']??false){
        //     $query->where(
        //         'is_completed',
        //         $filters['status'] === 'completed'
        //     );
        // }
        if(!empty($filters['status'])) {
            if($filters['status'] === 'completed') {
                $query->completed();
            } elseif ($filters['status'] === 'pending') {
                $query->pending();
            }
        }

        return $query
            ->latest()
            ->paginate(5)
            ->withQueryString();
    }
}
