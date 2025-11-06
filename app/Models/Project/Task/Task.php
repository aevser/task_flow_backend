<?php

namespace App\Models\Project\Task;

use App\Models\Project\Project;
use App\Models\User;
use App\Traits\Task\Filter\Filter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use InteractsWithMedia, Filter;

    protected $fillable = ['assignee_id', 'project_id', 'status_id', 'name', 'description', 'due_date'];

    protected $appends = ['attachments_urls'];

    protected $hidden = ['media'];

    // Вспомогательные методы

    protected function attachmentsUrls(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->getMedia('attachments')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'url' => $media->getUrl(),
                    ];
                })->toArray();
            }
        );
    }

    // Связи

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
