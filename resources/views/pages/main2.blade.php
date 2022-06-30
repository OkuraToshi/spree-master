@extends('layouts.app')
@section('css-files')
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/job.css')}}">
    <style>
        .card img{
            height: 20rem;
        }
        .card{
            border: none;
        }
        .card-footer{
            border: none;
        }
        .search{
            box-shadow: 20px 20px 50px 0px gray inset;
        }
        .sticky {
            position: -webkit-sticky;
            position: sticky;
            align-self: flex-start;
            top: 0;
            padding: 50px;
            font-size: 20px;
        }
        .garage-title {
            clear: both;
            white-space: nowrap;
            font-size: 16px;
        }
        @media (min-width: 576px) {

        }

        @media (min-width: 768px) {
            .jobContent{
                margin-left: 50px;
            }
        }

        @media (min-width: 1050px) {
            .jobContent{
                margin-left: 80px;
            }
        }

        @media (min-width: 1200px) {
            .jobContent{
                margin-left: 100px;
            }
        }
        @media (min-width: 1500px) {
            .jobContent{
                margin-left: 170px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 sticky" style="padding-top: 120px">

                <!-- Material form contact -->
                <div class="jobContent mt-0 mb-5" style="">
                    <div class="" style="background: none;">
                        <div class="col-sm-4">
                            <div class="filter">
                                <h4 style="clear: both;white-space: nowrap;">
                                    Discover {{$main}}
                                </h4>
                                <div class="accordion js-accordion" >
                                    @foreach($categories as $category)
                                        <div class="accordion__item js-accordion-item" >
                                            <div class="accordion-header js-accordion-header garage-title text-bold" >{{$category->name}}</div>
                                            <div class="accordion-body js-accordion-body">
                                                <div class="accordion-body__contents">

                                                    @foreach($category->child as $child)
                                                        <label class="toggle">
                                                            <input class="toggle__input" type="checkbox">
                                                            <span class="ml-3">
                                                            <a href="{{route('category.child',[$main,$category->name,$child->name])}}" class="toggle__text text-gray garage-title">{{$child->name}}</a>
                                                        </span>
                                                        </label>
                                                    @endforeach


                                                </div>
                                            </div><!-- end of accordion body -->

                                        </div><!-- end of accordion item -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Material form contact -->
            </div>
            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-9 mt-5">
                <div class="text-center" style="margin-bottom: 3rem">
                    <h4 class=""> <b>Editor's Picks for {{$name != null ? $name : $main}}</b> </h4>
                </div>
                <div class="product">
                    <!--- Cards -->
                    <div class="container-fluid">
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-sm-4 col-md-4 col-lg-3 col-xl-2 ml-5">
                                    <div class="card" style="margin-bottom: 1rem">
                                        <a href="{{route('product.show',[$product->slug,'Health & Beauty'])}}"><img class="card-img-top" style="height: 120%;width: 120%" src="{{asset('storage/product/'.$product->thumbnail)}}"></a>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-bold mb-1">{{$product->user->vendor_profile->brand_name}}</p>
                                        <p title="Source Title" style="font-size: 13px" class="mb-1">{{$product->name}}</p>
                                        <p class="text-bold">${{$product->price}}.00</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var accordion = (function () {

            var $accordion = $('.js-accordion');
            var $accordion_header = $accordion.find('.js-accordion-header');
            var $accordion_item = $('.js-accordion-item');

            // default settings
            var settings = {
                // animation speed
                speed: 3000,

                // close all other accordion items if true
                oneOpen: true
            };

            return {
                // pass configurable object literal
                init: function ($settings) {
                    $accordion_header.on('click', function () {
                        accordion.toggle($(this));

                        setTimeout(() => {
                            $('body, html').animate({

                            }, 0)
                        }, 0)
                    });

                    $.extend(settings, $settings);

                    // ensure only one accordion is active if oneOpen is true
                    if (settings.oneOpen && $('.js-accordion-item.active').length > 1) {
                        $('.js-accordion-item.active:not(:first)').removeClass('active');
                    }

                    // reveal the active accordion bodies
                    $('.js-accordion-item.active').find('> .js-accordion-body').show();
                },
                toggle: function ($this) {

                    if (settings.oneOpen && $this[0] != $this.closest('.js-accordion').find('> .js-accordion-item.active > .js-accordion-header')[0]) {
                        $this.closest('.js-accordion')
                            .find('> .js-accordion-item')
                            .removeClass('active')
                            .find('.js-accordion-body')
                            .slideUp()
                    }

                    // show/hide the clicked accordion item
                    $this.closest('.js-accordion-item').toggleClass('active');
                    $this.next().stop().slideToggle(settings.speed);
                }
            }
        })();

        $(document).ready(function () {
            accordion.init({ speed: 1000, oneOpen: true });
        });
    </script>
@endsection
