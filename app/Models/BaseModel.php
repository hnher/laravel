<?php
/**
 * BaseModel.php
 * Created On 2020/6/18 2:47 下午
 * Create by Retr0
 */

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\BaseModel
 *
 * @method static Builder|BaseModel newModelQuery()
 * @method static Builder|BaseModel newQuery()
 * @method static Builder|BaseModel query()
 * @method static Builder where(Closure|string|array $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static Builder whereIn(string $column, mixed $values, bool $strict = false)
 * @method static Builder whereBetween(string $column, array $values)
 * @method static Builder whereNotBetween(string $column, array $values)
 * @method static Builder whereNotIn(string $column, mixed $values, bool $strict = false)
 * @method static Model|$this create(string $attributes = [])
 * @mixin Model
 */
class BaseModel extends Model
{
    protected $connection = 'master';
}
