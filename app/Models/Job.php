<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['client_id'];
    public $timestamps = true;
    //protected $guarded = [];

    public function Client(){
        return $this->hasOne(Client::class, 'id','client_id' );
    }

    public function Performer()
    {
        return $this->hasOne(User::class, 'id', 'performer_id');
    }

    public function VinFrame(){
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }

    public function Brand(){
        return $this->hasOne(brand::class, 'id');
    }

    public function Models(){
        return $this->hasOne(models::class, 'id');
    }

    public function Creator(){
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    public function Tasks()
    {
        return $this->hasMany(Task::class, 'job_id');
    }

    public function getTaskCatalogue()
    {
        return $this->hasMany(task_catalogue::class, 'id','task_catalogue_id');
    }

    public function getParts()
    {
        return $this->hasMany(Parts::class, 'job_id');
    }

    public function getClientFullName()
    {
        if ($this->Client) {
            return $this->client->name;
        }
        return '';
    }

    public function getClientPhoneNumber()
    {
        if ($this->client) {
            return $this->client->phone;
        }
        return '';
    }

    public function getVehicleFrameNumber()
    {
        if ($this->VinFrame) {
            return $this->VinFrame->frame_number;
        }
        return '';
    }

    public function getModelName()
    {
        if ($this->VinFrame) {
            return $this->VinFrame->Models->name;
        }
        return '';
    }


    public function getBrandName()
    {
        if ($this->VinFrame && $this->VinFrame->Models && $this->VinFrame->Models->Brand) {
        //if ($this->Brand) {
            //return $this->Brand->name;
            return $this->VinFrame->Models->Brand->name;
        }
        return '';
    }

    public function getCreatorName()
    {
        if ($this->Creator) {
            return $this->Creator->name;
        }
        return '';
    }

    public function getPerformerName()
    {
        if ($this->performer) {
            return $this->performer->name;
        }
        return '';
    }

    public function getPerformerPrice()
    {
        $performerPrice = 0;

/*        if (! isset($this->tasks)) {
            $this->tasks;
        }*/

        foreach ($this->tasks as $task) {
            if ($task->price != 0 && $task->performer_percent != 0) {
                $performerPrice += $task->price * ($task->performer_percent / 100);
            }
        }

        return $performerPrice;
    }

    public function getTaskTotalPrice()
    {
        $TasktotalPrice = 0;

        /*        if (! isset($this->tasks)) {
                    $this->tasks;
                }*/

        foreach ($this->tasks as $task) {
            if ($task->price != 0) {
                $TasktotalPrice += $task->price;
            }
        }

        return $TasktotalPrice;
    }

    public function getPartsTotalPrice()
    {
        $PartstotalPrice = 0;


        foreach ($this->getParts as $part) {
            if ($part->price != 0 && $part->quantity != 0) {
                $PartstotalPrice += ($part->price * $part->quantity);
            }
        }

        return $PartstotalPrice;
    }

    public function getTotalPrice()
    {
        $totalPrice = 0;

        /*if (! isset($this->tasks)) {
            $this->tasks;
        }*/

        foreach ($this->Tasks as $task) {
            if ($task->price != 0) {
                $totalPrice += $task->price;
            }
        }

        /*if (! isset($this->getParts)) {
            $this->getParts;
        }*/

        foreach ($this->getParts as $part) {
            if ($part->price != 0 && $part->quantity != 0) {
                $totalPrice += ($part->price * $part->quantity);
            }
        }

        return $totalPrice;
    }

}
