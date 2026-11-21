<?php

namespace App\Actions;

use Throwable;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\DB;

class CreateIdea{

    public function __construct(#[CurrentUser] protected User $user){

    }


    /**
     * @throws Throwable
     */
    public function handle(array $attributes): void{

        $data= collect($attributes)->only(['title','description','status','links'])->toArray();

        if($attributes['image'] ?? false){
            $data['image_path'] = $attributes['image']->store('images','public');
        }

        DB::transaction(function () use ($data,$attributes){
            $idea =$this->user->ideas()->create($data);

           // $steps=  collect($attributes['steps'] ?? [])->map(fn ($step) => ['description' => $step])->all();


             $idea->steps()->createMany($attributes['steps'] ?? []);
        });

    }



}
