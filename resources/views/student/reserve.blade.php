@extends('layouts.base')
@include('layouts.head')
@include('layouts.footer')
@section('content')

@include('components.student_navbar')
@include('components.inner_head')
<!-- section -->
<div class="section padding_layout_1" id="register">
<div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="main_heading text_align_center">
            <h2>授業を予約</h2>
          </div>
        </div>
      </div>
    </div><!-- /row -->

    <div id="ad_teachers" class="available_teachers">

    <ul class="horizontal-list">
        
        @for($i = 0; $i < $av_lectures->count(); $i++)
        
        <a href="" class="horizontal-item">
          <div class="item-contents">
            <p class="item-text text-white"><i class="fas fa-flag-usa mr-1 fa-fw"></i>{{$names[$i]['subject_name']}}</p>
            <p class="item-text text-white"><i class="far fa-calendar-alt mr-1 fa-fw"></i>{{$av_lectures[$i]->date}}</p>
            <p class="item-text text-white"><i class="far fa-clock mr-1 fa-fw"></i><?= substr($av_lectures[$i]->start_time, 0, 5) ?> - <?= substr($av_lectures[$i]->end_time, 0, 5); ?></p>
            <p class="item-text text-white"><i class="fas fa-chalkboard-teacher mr-1 fa-fw"></i>{{$names[$i]['teacher_name']}}</p>
          </div>
        </a>
        
        @endfor

      </ul>

    </div>


</div><!-- container -->
</div><!-- /section -->
@endsection