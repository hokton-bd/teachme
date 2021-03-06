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
          <div class="main_heading text_align_center">
            <h2>ホーム</h2>
          </div>
        </div>
      </div>
    </div><!-- /row -->

    <div class="coming-classes mb-5">
      <h5>次の授業</h5>
      <ul class="horizontal-list">

        @if($coming_lectures->count() != 0)
        @for($i = 0; $i < $coming_lectures->count(); $i++)
          <li class="horizontal-item">
            <div class="item-contents">
              <p class="item-text text-white"><i class="far fa-calendar-alt mr-1 fa-fw"></i>日:<?= substr($coming_lectures[$i]->date, 5);?></p>
              <p class="item-text text-white"><i class="far fa-calendar-alt mr-1 fa-fw"></i>時間: <?= substr($coming_lectures[$i]->start_time, 0, 5); ?> - <?= substr($coming_lectures[$i]->end_time, 0, 5)?></p>
              <p class="item-text text-white"><i class="fas fa-user mr-1 fa-fw"></i>生徒: {{$names[$i]}}</p>
            </div>
          </li>
        @endfor
        @else

          <p>授業は予約されていません</p>

        @endif

      </ul>
    </div><!-- /coming-classes -->

</div>
</div>
@endsection