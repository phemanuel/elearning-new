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
                    <h4>Edit Course</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('course.index')}}">Courses</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit Course</a></li>
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
                        <form action="{{route('course.updateforAdmin',encryptor('encrypt', $course->id))}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$course->id)}}">
                            <div class="row">
                            <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="0" @if(old('status',$course->status)==0) selected
                                                @endif>Pending</option>
                                            <option value="1" @if(old('status',$course->status)==1) selected
                                                @endif>Inactive</option>
                                            <option value="2" @if(old('status',$course->status)==2) selected
                                                @endif>Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="courseTitle_en"
                                            value="{{old('courseTitle_en',$course->title_en)}}">
                                    </div>
                                    @if($errors->has('courseTitle_en'))
                                    <span class="text-danger"> {{ $errors->first('courseTitle_en') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">টাইটেল (বাংলায়)</label>
                                        <input type="text" class="form-control" name="courseTitle_bn"
                                            value="{{old('courseTitle_bn',$course->title_bn)}}">
                                    </div>
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control"
                                            name="courseDescription_en">{{old('courseDescription_en',$course->description_en)}}</textarea>
                                    </div>
                                    @if($errors->has('courseDescription_en'))
                                    <span class="text-danger"> {{ $errors->first('courseDescription_en') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">বিস্তারিত (বাংলায়)</label>
                                        <textarea class="form-control"
                                            name="courseDescription_bn">{{old('courseDescription_bn',$course->description_bn)}}</textarea>
                                    </div>
                                    @if($errors->has('courseDescription_bn'))
                                    <span class="text-danger"> {{ $errors->first('courseDescription_bn') }}</span>
                                    @endif
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <select class="form-control" name="categoryId">
                                            @forelse ($courseCategory as $c)
                                            <option value="{{$c->id}}" {{old('categoryId', $course->course_category_id) ==
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
                                            <option value="{{$i->id}}" {{old('instructorId', $course->instructor_id) ==
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
                                            <option value="free" @if(old('courseType', $course->type)=='free' ) selected
                                                @endif>Free
                                            </option>
                                            <option value="paid" @if(old('courseType', $course->type)=='paid' ) selected
                                                @endif>Paid
                                            </option>
                                            <option value="subscription" @if(old('courseType', $course->type)
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
                                            <option value="beginner" @if(old('courseDifficulty', $course->
                                                difficulty)=='beginner' ) selected @endif>Beginner
                                            </option>
                                            <option value="intermediate" @if(old('courseDifficulty', $course->
                                                difficulty)=='intermediate' ) selected @endif>Intermediate
                                            </option>
                                            <option value="advanced" @if(old('courseDifficulty', $course->
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
                                            <option value="=N=" @if(old('currencyType', $course->currency_type)=='=N=' ) selected
                                                @endif>NAIRA
                                            </option>
                                            <option value="$" @if(old('currencyType', $course->currency_type)=='$' ) selected
                                                @endif>USD
                                            </option>
                                            <option value="£" @if(old('currencyType', $course->currency_type)=='£' )selected 
                                                @endif>POUNDS</option>
                                                <option value="€" @if(old('currencyType', $course->currency_type)=='€' )selected 
                                                @endif>EURO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Price</label>
                                        <input type="number" class="form-control" name="coursePrice"
                                            value="{{old('coursePrice', $course->price)}}">
                                    </div>
                                    @if($errors->has('coursePrice'))
                                    <span class="text-danger"> {{ $errors->first('coursePrice') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Old Price</label>
                                        <input type="number" class="form-control" name="courseOldPrice"
                                            value="{{old('courseOldPrice', $course->old_price)}}">
                                    </div>
                                    @if($errors->has('courseOldPrice'))
                                    <span class="text-danger"> {{ $errors->first('courseOldPrice') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Price</label>
                                        <input type="number" class="form-control" name="subscription_price"
                                            value="{{old('subscription_price', $course->subscription_price)}}">
                                    </div>
                                    @if($errors->has('subscription_price'))
                                    <span class="text-danger"> {{ $errors->first('subscription_price',
                                        $course->subscription_price) }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Start Date Enabled - (Course will not start until the start date.)</label>
                                        <select class="form-control" name="dateEnabled">
                                            <option value="1" @if(old('dateEnabled', $course->
                                                date_enabled)=='1' ) selected @endif>Yes
                                            </option>
                                            <option value="0" @if(old('dateEnabled', $course->
                                                date_enabled)=='0' ) selected @endif>No
                                            </option>
                                        </select>
                                    </div>
                                    @if($errors->has('dateEnabled'))
                                    <span class="text-danger"> {{ $errors->first('dateEnabled') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Start From</label>
                                        <input type="date" class="form-control" name="start_from" value="{{old('start_from')}}">
                                    </div>
                                    @if($errors->has('start_from'))
                                    <span class="text-danger"> {{ $errors->first('start_from',
                                        $course->start_from) }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Duration(Weeks)</label>
                                        <input type="number" class="form-control" name="duration" value="{{old('duration',$course->duration)}}">
                                    </div>
                                    @if($errors->has('duration'))
                                    <span class="text-danger"> {{ $errors->first('duration') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Number of Segment</label>
                                        <input type="number" class="form-control" name="segment" value="{{old('segment',$course->segment)}}">
                                    </div>
                                    @if($errors->has('segment'))
                                    <span class="text-danger"> {{ $errors->first('segment') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Prerequisites</label>
                                        <textarea class="form-control"
                                            name="prerequisites_en">{{old('prerequisites_en',$course->prerequisites_en)}}</textarea>
                                    </div>
                                    @if($errors->has('prerequisites_en'))
                                    <span class="text-danger"> {{ $errors->first('prerequisites_en') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">পূর্বশর্ত (বাংলায়)</label>
                                        <textarea class="form-control"
                                            name="prerequisites_bn">{{old('prerequisites_bn',$course->prerequisites_bn)}}</textarea>
                                    </div>
                                    @if($errors->has('prerequisites_bn'))
                                    <span class="text-danger"> {{ $errors->first('prerequisites_bn') }}</span>
                                    @endif
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Course Code</label>
                                        <input type="text" class="form-control" name="course_code"
                                            value="{{old('course_code', $course->course_code)}}">
                                    </div>
                                    @if($errors->has('course_code'))
                                    <span class="text-danger"> {{ $errors->first('course_code') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Enable Project</label>
                                        <select class="form-control" name="project">
                                            <option value="1" @if(old('project', $course->tag)=='1' ) selected
                                                @endif>Yes
                                            </option>
                                            <option value="0" @if(old('project', $course->tag)=='0' ) selected
                                                @endif>No
                                            </option>                                            
                                        </select>
                                    </div>
                                    @if($errors->has('project'))
                                    <span class="text-danger"> {{ $errors->first('project') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Thumbnail Video URL</label>
                                        <input type="text" class="form-control" name="thumbnail_video"
                                            value="{{old('thumbnail_video',$course->thumbnail_video)}}">
                                    </div>
                                    @if($errors->has('thumbnail_video'))
                                    <span class="text-danger"> {{ $errors->first('thumbnail_video') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Course Tag</label>
                                        <select class="form-control" name="tag">
                                            <option value="popular" @if(old('tag', $course->tag)=='popular' ) selected
                                                @endif>Popular
                                            </option>
                                            <option value="featured" @if(old('tag', $course->tag)=='featured' ) selected
                                                @endif>Featured
                                            </option>tag
                                            <option value="upcoming" @if(old('tag', $course->tag)=='upcoming' ) selected
                                                @endif>Upcoming</option>
                                        </select>
                                    </div>
                                    @if($errors->has('tag'))
                                    <span class="text-danger"> {{ $errors->first('tag') }}</span>
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

                        @if(!fullAccess())
                        <form action="{{route('course.update',encryptor('encrypt', $course->id))}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$course->id)}}">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="courseTitle_en"
                                            value="{{old('courseTitle_en',$course->title_en)}}">
                                    </div>
                                    @if($errors->has('courseTitle_en'))
                                    <span class="text-danger"> {{ $errors->first('courseTitle_en') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">টাইটেল (বাংলায়)</label>
                                        <input type="text" class="form-control" name="courseTitle_bn"
                                            value="{{old('courseTitle_bn',$course->title_bn)}}">
                                    </div>
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control"
                                            name="courseDescription_en">{{old('courseDescription_en',$course->description_en)}}</textarea>
                                    </div>
                                    @if($errors->has('courseDescription_en'))
                                    <span class="text-danger"> {{ $errors->first('courseDescription_en') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">বিস্তারিত (বাংলায়)</label>
                                        <textarea class="form-control"
                                            name="courseDescription_bn">{{old('courseDescription_bn',$course->description_bn)}}</textarea>
                                    </div>
                                    @if($errors->has('courseDescription_bn'))
                                    <span class="text-danger"> {{ $errors->first('courseDescription_bn') }}</span>
                                    @endif
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <select class="form-control" name="categoryId">
                                            @forelse ($courseCategory as $c)
                                            <option value="{{$c->id}}" {{old('categoryId', $course->course_category_id) ==
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
                                            <option value="{{$i->id}}" {{old('instructorId', $course->instructor_id) ==
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
                                            <option value="free" @if(old('courseType', $course->type)=='free' ) selected
                                                @endif>Free
                                            </option>
                                            <option value="paid" @if(old('courseType', $course->type)=='paid' ) selected
                                                @endif>Paid
                                            </option>
                                            <option value="subscription" @if(old('courseType', $course->type)
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
                                            <option value="beginner" @if(old('courseDifficulty', $course->
                                                difficulty)=='beginner' ) selected @endif>Beginner
                                            </option>
                                            <option value="intermediate" @if(old('courseDifficulty', $course->
                                                difficulty)=='intermediate' ) selected @endif>Intermediate
                                            </option>
                                            <option value="advanced" @if(old('courseDifficulty', $course->
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
                                            <option value="=N=" @if(old('currencyType', $course->currency_type)=='=N=' ) selected
                                                @endif>NAIRA
                                            </option>
                                            <option value="$" @if(old('currencyType', $course->currency_type)=='$' ) selected
                                                @endif>USD
                                            </option>
                                            <option value="£" @if(old('currencyType', $course->currency_type)=='£' )selected 
                                                @endif>POUNDS</option>
                                                <option value="€" @if(old('currencyType', $course->currency_type)=='€' )selected 
                                                @endif>EURO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Price</label>
                                        <input type="number" class="form-control" name="coursePrice"
                                            value="{{old('coursePrice', $course->price)}}">
                                    </div>
                                    @if($errors->has('coursePrice'))
                                    <span class="text-danger"> {{ $errors->first('coursePrice') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Old Price</label>
                                        <input type="number" class="form-control" name="courseOldPrice"
                                            value="{{old('courseOldPrice', $course->old_price)}}">
                                    </div>
                                    @if($errors->has('courseOldPrice'))
                                    <span class="text-danger"> {{ $errors->first('courseOldPrice') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Subscription Price</label>
                                        <input type="number" class="form-control" name="subscription_price"
                                            value="{{old('subscription_price', $course->subscription_price)}}">
                                    </div>
                                    @if($errors->has('subscription_price'))
                                    <span class="text-danger"> {{ $errors->first('subscription_price',
                                        $course->subscription_price) }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Start Date Enabled - (Course will not start until the start date.)</label>
                                        <select class="form-control" name="dateEnabled">
                                            <option value="1" @if(old('dateEnabled', $course->
                                                date_enabled)=='1' ) selected @endif>Yes
                                            </option>
                                            <option value="0" @if(old('dateEnabled', $course->
                                                date_enabled)=='0' ) selected @endif>No
                                            </option>
                                        </select>
                                    </div>
                                    @if($errors->has('dateEnabled'))
                                    <span class="text-danger"> {{ $errors->first('dateEnabled') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Start From</label>
                                        <input type="date" class="form-control" name="start_from" value="{{old('start_from')}}">
                                    </div>
                                    @if($errors->has('start_from'))
                                    <span class="text-danger"> {{ $errors->first('start_from',
                                        $course->start_from) }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Duration(Weeks)</label>
                                        <input type="number" class="form-control" name="duration" value="{{old('duration',$course->duration)}}">
                                    </div>
                                    @if($errors->has('duration'))
                                    <span class="text-danger"> {{ $errors->first('duration') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Number of Segment</label>
                                        <input type="number" class="form-control" name="segment" value="{{old('segment',$course->segment)}}">
                                    </div>
                                    @if($errors->has('segment'))
                                    <span class="text-danger"> {{ $errors->first('segment') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Prerequisites</label>
                                        <textarea class="form-control"
                                            name="prerequisites_en">{{old('prerequisites_en',$course->prerequisites_en)}}</textarea>
                                    </div>
                                    @if($errors->has('prerequisites_en'))
                                    <span class="text-danger"> {{ $errors->first('prerequisites_en') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">পূর্বশর্ত (বাংলায়)</label>
                                        <textarea class="form-control"
                                            name="prerequisites_bn">{{old('prerequisites_bn',$course->prerequisites_bn)}}</textarea>
                                    </div>
                                    @if($errors->has('prerequisites_bn'))
                                    <span class="text-danger"> {{ $errors->first('prerequisites_bn') }}</span>
                                    @endif
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Course Code</label>
                                        <input type="text" class="form-control" name="course_code"
                                            value="{{old('course_code', $course->course_code)}}">
                                    </div>
                                    @if($errors->has('course_code'))
                                    <span class="text-danger"> {{ $errors->first('course_code') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Enable Project</label>
                                        <select class="form-control" name="project">
                                            <option value="1" @if(old('project', $course->tag)=='1' ) selected
                                                @endif>Yes
                                            </option>
                                            <option value="0" @if(old('project', $course->tag)=='0' ) selected
                                                @endif>No
                                            </option>                                            
                                        </select>
                                    </div>
                                    @if($errors->has('project'))
                                    <span class="text-danger"> {{ $errors->first('project') }}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Thumbnail Video URL</label>
                                        <input type="text" class="form-control" name="thumbnail_video"
                                            value="{{old('thumbnail_video',$course->thumbnail_video)}}">
                                    </div>
                                    @if($errors->has('thumbnail_video'))
                                    <span class="text-danger"> {{ $errors->first('thumbnail_video') }}</span>
                                    @endif
                                </div>
                                {{--<div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Course Tag</label>
                                        <select class="form-control" name="tag">
                                            <option value="popular" @if(old('tag', $course->tag)=='popular' ) selected
                                                @endif>Popular
                                            </option>
                                            <option value="featured" @if(old('tag', $course->tag)=='featured' ) selected
                                                @endif>Featured
                                            </option>tag
                                            <option value="upcoming" @if(old('tag', $course->tag)=='upcoming' ) selected
                                                @endif>Upcoming</option>
                                        </select>
                                    </div>
                                    @if($errors->has('tag'))
                                    <span class="text-danger"> {{ $errors->first('tag') }}</span>
                                    @endif
                                </div>--}}
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