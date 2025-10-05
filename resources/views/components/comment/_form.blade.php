@php
  /**
   * @var \Illuminate\Database\Eloquent\Model $model
   * @var int $maxLength
   */
  $containerId = 'comment-form-' . $model->id;
@endphp

<div class="card comment-form-container" id="{{ $containerId }}">
  <div class="card-body">
    {{ html()->form(action: route('comments.store'))->open() }}
    {{ html()->hidden('commentable_type')->value(get_class($model)) }}
    {{ html()->hidden('commentable_id')->value($model->id) }}
    
    {{-- Плейсхолдер/лейбл над полем ввода --}}
    <div class="mb-2">
      <label for="content-{{ $model->id }}" class="form-label comment-label w-100 text-wrap">
        {{ __('comment.enter_your_message', ['max' => $maxCommentLength]) }}
      </label>
    </div>
    
    {{-- Поле ввода --}}
    <div>
      {{ html()
        ->textarea('content')
        ->id('content-' . $model->id)
        ->class('form-control x-min-h-100px comment-textarea')
        ->attribute('data-max-length', $maxCommentLength)
        ->attribute('maxlength', $maxCommentLength)
        ->attribute('placeholder', '') // Убираем плейсхолдер, так как он теперь выше
        ->required() }}
    </div>

    {{-- Счетчик символов --}}
    <div class="mt-2">
      <small class="text-muted">
        {{ __('comment.characters_used') }}: 
        <span class="char-counter">0</span>/{{ $maxCommentLength }}
      </small>
      <div class="text-danger small max-length-warning d-none">
        ⚠ {{ __('comment.max_length_reached') }}
      </div>
    </div>

    <div class="mt-3">
      {{ html()->submit(__('comment.submit'))->class('btn btn-success btn-sm text-uppercase') }}
    </div>
    {{ html()->form()->close() }}
  </div>
</div>
