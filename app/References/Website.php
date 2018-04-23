<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Mpociot\Firebase\SyncsWithFirebase;

class Website extends Model {

    use SyncsWithFirebase;

    protected $fillable = ['email'];

    protected $visible = ['id', 'email'];

}