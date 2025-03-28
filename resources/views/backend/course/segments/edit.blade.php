@extends('backend.layouts.app')
@section('title', 'Edit Instructor')

@push('styles')
<!-- Pick date -->
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/pickadate/themes/default.date.css')}}">
@endpush

@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Course Segment</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('course.index')}}">My Courses</a></li>                    
                    <li class="breadcrumb-item active"><a href="{{route('segment.show', encryptor('encrypt', $course->id))}}">Segments</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit Segment</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Basic Info</h5>
                    </div>
                    <div class="card-body">
                        @if(fullAccess())
                        <form action="{{route('segment.updateforAdmin',encryptor('encrypt', $segment->id))}}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$segment->id)}}">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="0" @if(old('status',$segment->status)==0) selected
                                                @endif>Pending</option>
                                            <option value="1" @if(old('status',$segment->status)==1) selected
                                                @endif>Inactive</option>
                                            <option value="2" @if(old('status',$segment->status)==2) selected
                                                @endif>Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Course Name</label>
                                        <input type="text" class="form-control" name="courseTitle_en"
                                            value="{{old('courseTitle_en',$segment->title_en)}}">
                                    </div>
                                    @if($errors->has('courseTitle_en'))
                                    <span class="text-danger"> {{ $errors->first('courseTitle_en') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">টাইটেল (বাংলায়)</label>
                                        <input type="text" class="form-control" name="courseTitle_bn"
                                            value="{{old('courseTitle_bn',$segment->title_bn)}}">
                                    </div>
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control"
                                            name="courseDescription_en">{{old('courseDescription_en',$segment->description_en)}}</textarea>
                                    </div>
                                    @if($errors->has('courseDescription_en'))
                                    <span class="text-danger"> {{ $errors->first('courseDescription_en') }}</span>
                                    @endif
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <select class="form-control" name="categoryId">
                                            @forelse ($courseCategory as $c)
                                            <option value="{{$c->id}}" {{old('categoryId', $segment->course_category_id) ==
                                                $c->id?'selected':''}}>
                                                {{$c->category_name}}</option>
                                            @empty
                                            <option value="">No Category Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    @if($errors->has('categoryId'))
                                    <span class="text-danger"> {{ $errors->first('categoryId') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Instructor</label>
                                        <select class="form-control" name="instructorId">
                                            @forelse ($instructor as $i)
                                            <option value="{{$i->id}}" {{old('instructorId', $segment->instructor_id) ==
                                                $i->id?'selected':''}}>
                                                {{$i->name_en}}</option>
                                            @empty
                                            <option value="">No Instructor Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    @if($errors->has('instructorId'))
                                    <span class="text-danger"> {{ $errors->first('instructorId') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Type</label>
                                        <select class="form-control" name="courseType">
                                            <option value="free" @if(old('courseType', $segment->type)=='free' ) selected
                                                @endif>Free
                                            </option>
                                            <option value="paid" @if(old('courseType', $segment->type)=='paid' ) selected
                                                @endif>Paid
                                            </option>
                                            <option value="subscription" @if(old('courseType', $segment->type)
                                                =='subscription' )
                                                selected @endif>Subscription-based</option>
                                        </select>
                                    </div>
                                    @if($errors->has('courseType'))
                                    <span class="text-danger"> {{ $errors->first('courseType') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Difficulty</label>
                                        <select class="form-control" name="courseDifficulty">
                                            <option value="beginner" @if(old('courseDifficulty', $segment->
                                                difficulty)=='beginner' ) selected @endif>Beginner
                                            </option>
                                            <option value="intermediate" @if(old('courseDifficulty', $segment->
                                                difficulty)=='intermediate' ) selected @endif>Intermediate
                                            </option>
                                            <option value="advanced" @if(old('courseDifficulty', $segment->
                                                difficulty)=='advanced' )
                                                selected @endif>Advanced</option>
                                        </select>
                                    </div>
                                    @if($errors->has('courseDifficulty'))
                                    <span class="text-danger"> {{ $errors->first('courseDifficulty') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Currency Type</label>
                                        <select class="form-control" name="currencyType">
                                            <option value="=N=" @if(old('currencyType', $segment->currency_type)=='=N=' ) selected
                                                @endif>Naira
                                            </option>
                                            <option value="$" @if(old('currencyType', $segment->currency_type)=='$' ) selected
                                                @endif>Dollar
                                            </option>
                                            <option value="£" @if(old('currencyType', $segment->currency_type)=='£' )selected 
                                                @endif>Pounds</option>
                                                <option value="€" @if(old('currencyType', $segment->currency_type)=='€' )selected 
                                                @endif>Euro</option>
                                        </select>
                                    </div>
                                    @if($errors->has('currencyType'))
                                    <span class="text-danger"> {{ $errors->first('currencyType') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Price</label>
                                        <input type="number" class="form-control" name="coursePrice"
                                            value="{{old('coursePrice', $segment->price)}}">
                                    </div>
                                    @if($errors->has('coursePrice'))
                                    <span class="text-danger"> {{ $errors->first('coursePrice') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Old Price</label>
                                        <input type="number" class="form-control" name="courseOldPrice"
                                            value="{{old('courseOldPrice', $segment->old_price)}}">
                                    </div>
                                    @if($errors->has('courseOldPrice'))
                                    <span class="text-danger"> {{ $errors->first('courseOldPrice') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Price</label>
                                        <input type="number" class="form-control" name="subscription_price"
                                            value="{{old('subscription_price')}}">
                                    </div>
                                    @if($errors->has('subscription_price'))
                                    <span class="text-danger"> {{ $errors->first('subscription_price',
                                        $segment->subscription_price) }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Start From</label>
                                        <input type="date" class="form-control" name="start_from"
                                            value="{{old('start_from')}}">
                                    </div>
                                    @if($errors->has('start_from'))
                                    <span class="text-danger"> {{ $errors->first('start_from',
                                        $segment->start_from) }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Duration</label>
                                        <input type="number" class="form-control" name="duration"
                                            value="{{old('duration',$segment->duration)}}">
                                    </div>
                                    @if($errors->has('duration'))
                                    <span class="text-danger"> {{ $errors->first('duration') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Number of Lesson</label>
                                        <input type="number" class="form-control" name="lesson"
                                            value="{{old('lesson',$segment->lesson)}}">
                                    </div>
                                    @if($errors->has('lesson'))
                                    <span class="text-danger"> {{ $errors->first('lesson') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Prerequisites</label>
                                        <textarea class="form-control"
                                            name="prerequisites_en">{{old('prerequisites_en',$segment->prerequisites_en)}}</textarea>
                                    </div>
                                    @if($errors->has('prerequisites_en'))
                                    <span class="text-danger"> {{ $errors->first('prerequisites_en') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">পূর্বশর্ত (বাংলায়)</label>
                                        <textarea class="form-control"
                                            name="prerequisites_bn">{{old('prerequisites_bn',$segment->prerequisites_bn)}}</textarea>
                                    </div>
                                    @if($errors->has('prerequisites_bn'))
                                    <span class="text-danger"> {{ $errors->first('prerequisites_bn') }}</span>
                                    @endif
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Course Code</label>
                                        <input type="number" class="form-control" name="course_code"
                                            value="{{old('course_code', $segment->course_code)}}">
                                    </div>
                                    @if($errors->has('course_code'))
                                    <span class="text-danger"> {{ $errors->first('course_code') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Thumbnail Video URL</label>
                                        <input type="text" class="form-control" name="thumbnail_video"
                                            value="{{old('thumbnail_video',$segment->thumbnail_video)}}">
                                    </div>
                                    @if($errors->has('thumbnail_video'))
                                    <span class="text-danger"> {{ $errors->first('thumbnail_video') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Course Tag</label>
                                        <select class="form-control" name="tag">
                                            <option value="popular" @if(old('tag', $segment->tag)=='popular' ) selected
                                                @endif>Popular
                                            </option>
                                            <option value="featured" @if(old('tag', $segment->tag)=='featured' ) selected
                                                @endif>Featured
                                            </option>tag
                                            <option value="upcoming" @if(old('tag', $segment->tag)=='upcoming' ) selected
                                                @endif>Upcoming</option>
                                        </select>
                                    </div>
                                    @if($errors->has('tag'))
                                    <span class="text-danger"> {{ $errors->first('tag') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Enable QUiz</label>
                                        <select class="form-control" name="quiz">
                                            <option value="1" @if(old('quiz', $course->tag)=='1' ) selected
                                                @endif>Yes
                                            </option>
                                            <option value="0" @if(old('quiz', $course->tag)=='0' ) selected
                                                @endif>No
                                            </option>                                            
                                        </select>
                                    </div>
                                    @if($errors->has('quiz'))
                                    <span class="text-danger"> {{ $errors->first('quiz') }}</span>
                                    @endif
                                </div>   
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label">Image</label>
                                    <div class="form-group fallback w-100">
                                        <input type="file" class="dropify" data-default-file="" name="image">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label">Thumbnail Image</label>
                                    <div class="form-group fallback w-100">
                                        <input type="file" class="dropify" data-default-file="" name="thumbnail_image">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="submit" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                        @endif

                        @if(!fullAccess())
                        <form action="{{route('segment.update',encryptor('encrypt', $segment->id))}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$segment->id)}}">
                            <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Segment No</label>
                                        <select class="form-control" name="segmentNo">
                                            <option value="">Select Segment</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ old('segmentNo', $segment->segment_no) == $i ? 'selected' : '' }}>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    @if($errors->has('segmentNo'))
                                        <span class="text-danger">{{ $errors->first('segmentNo') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Segment Name</label>
                                        <input type="text" class="form-control" name="title_en"
                                            value="{{old('title_en',$segment->title_en)}}">
                                    </div>
                                    @if($errors->has('title_en'))
                                    <span class="text-danger"> {{ $errors->first('title_en') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control"
                                            name="description_en">{{old('description_en',$segment->description_en)}}</textarea>
                                    </div>
                                    @if($errors->has('description_en'))
                                    <span class="text-danger"> {{ $errors->first('description_en') }}</span>
                                    @endif
                                </div>                              
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Number of Lesson</label>
                                        <input type="number" class="form-control" name="lesson" value="{{old('lesson',$segment->lesson)}}">
                                    </div>
                                    @if($errors->has('lesson'))
                                    <span class="text-danger"> {{ $errors->first('lesson') }}</span>
                                    @endif
                                </div>      
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Enable QUiz</label>
                                        <select class="form-control" name="quiz">
                                            <option value="1" @if(old('quiz', $course->tag)=='1' ) selected
                                                @endif>Yes
                                            </option>
                                            <option value="0" @if(old('quiz', $course->tag)=='0' ) selected
                                                @endif>No
                                            </option>                                            
                                        </select>
                                    </div>
                                    @if($errors->has('quiz'))
                                    <span class="text-danger"> {{ $errors->first('quiz') }}</span>
                                    @endif
                                </div>                          
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label">Image</label>
                                    <div class="form-group fallback w-100">
                                        <input type="file" class="dropify" data-default-file="" name="image">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label">Thumbnail Image</label>
                                    <div class="form-group fallback w-100">
                                        <input type="file" class="dropify" data-default-file="" name="thumbnail_image">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="submit" class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<!-- pickdate -->
<script src="{{asset('vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendor/pickadate/picker.date.js')}}"></script>

<!-- Pickdate -->
<script src="{{asset('js/plugins-init/pickadate-init.js')}}"></script>
@endpush