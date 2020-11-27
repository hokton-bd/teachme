@extends('layouts.base')
@include('layouts.head')
@include('layouts.footer')
@section('content')
@include('components.teacher_navbar')
@include('components.inner_head')
<!-- section -->
<div class="section padding_layout_1" id="register">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="main_heading text_align_center mb-2">
            <h2>スケジュール</h2>
          </div>
        </div>
      </div>
    </div><!-- /row -->

    @isset($message)
    <p> {{$message}} </p>
    @endisset

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg px-2 d-block mx-auto" data-toggle="modal" data-target="#modelId">
    スケジュールを追加する
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">授業ができる日</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form method="post" action="{{route('add_shift')}}">
                @csrf
                    <div class="modal-body">
                            <input type="date" name="date" class="form-control mb-2" placeholder="" min="<?= date('Y-m-d'); ?>" required>
                            <div class="row px-3">
                                <select name="start_time" id="" class="form-control w-50 d-inline-block" reqiured>
                                    @for($i = 9; $i < 21; $i ++)
                                        <option value="{{ $i }}">{{ $i }}:00</option>
                                    @endfor
                                </select>
                                ～  40分
                            </div>                            
                    </div><!-- body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary">追加</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="coming-classes my-5">
      <h5>予定</h5>
      @isset($shifts)
      @if($shifts->count() != 0)

      <ul class="horizontal-list">
      @foreach($shifts as $item)
        <li class="horizontal-item">
          <div class="item-contents">
              <p class="item-text text-white"><i class="far fa-calendar-alt mr-1 fa-fw"></i>日:<?= substr($item->date, 5);?></p>
              <p class="item-text text-white"><i class="far fa-calendar-alt mr-1 fa-fw"></i>時間: <?= substr($item->start_time, 0, 5); ?> - <?= substr($item->end_time, 0, 5)?></p>
              <p class="item-text text-white"><i class="fas fa-user mr-1 fa-fw"></i>生徒: {{$item->name}}</p>
            </div>
        </li>
      @endforeach
      </ul>

      @else
        <p>予定がありません！  追加してください！</p>
      @endif
      @endisset

    </div><!-- /coming-classes -->


</div>
</div>
@endsection