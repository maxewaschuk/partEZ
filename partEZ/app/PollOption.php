<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'poll_options';

    protected $primaryKey = 'oid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option', 'pid'
    ];

    public static function getPollOptions($pid)
    {
        return PollOption::all()->where('pid', '=', $pid);
    }

    public function getVotes($pid, $oid)
    {
        return DB::table('poll_options')
            ->select('COUNT(*)')
            ->where('pid', '=', $pid, 'AND', 'oid', '=', $oid);
    }

    public static function savePollOption( $pollOption )
    {
        return $pollOption->save();
    }

}
