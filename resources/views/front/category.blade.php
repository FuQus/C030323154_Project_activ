@extends('layouts.app')
@section('title', 'training center poliban')
@section('content')

<div class="h-[112px]">
        <x-nav/>
    </div>
    <section id="Category" class="w-full max-w-[1280px] mx-auto px-[52px] mt-[52px] mb-[100px]">
        <div class="flex flex-col gap-9">
            <div class="flex flex-col items-center gap-1">
                <h1 class="font-Neue-Plak-bold text-[32px] leading-[44.54px] capitalize">
                    {{$category->name}} ({{$category->workshops->count()}})
                </h1>
                <div class="flex items-center gap-2 ">
                    <a class="font-medium text-aktiv-grey last:font-semibold last:text-aktiv-black" href="#">Homepage</a>
                    <span>></span>
                    <a class="font-medium text-aktiv-grey last:font-semibold last:text-aktiv-black" href="#">Category Workshop</a>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                @foreach ($category->workshops as $workshop)
                    <a href="{{ route('front.details', $workshop->slug) }}" class="card">
                        <div class="flex flex-col h-full justify-between rounded-3xl p-6 gap-9 bg-white">
                            <div class="flex flex-col gap-[18px]">
                                <div class="flex items-center gap-3">
                                    <img src="{{ Storage::url($workshop->instructor->avatar) }}" class="w-16 h-16 rounded-full flex shrink-0 overflow-hidden" 
                                         alt="Instructor Avatar">
                                    <div class="flex flex-col gap-[2px]">
                                        <p class="font-semibold text-lg leading-[27px]">
                                            {{ $workshop->instructor->name }}
                                        </p>
                                        <p class="font-medium text-aktiv-grey">{{ $workshop->instructor->occupation }}</p>
                                    </div>
                                </div>
    
                                <div class="thumbnail-container relative h-[200px] rounded-xl bg-[#D9D9D9] overflow-hidden">
                                    <img src="{{ Storage::url($workshop->thumbnail) }}" class="w-full h-full object-cover" alt="Workshop Thumbnail">
                                    @if($workshop->is_open)
                                        <div class="absolute top-3 left-3 flex items-center rounded-full py-3 px-5 gap-1 bg-aktiv-green text-white z-10">
                                            <img src="{{ asset('assets/images/icons/medal-star.svg') }}" class="w-6 h-6" alt="icon">
                                            <span class="font-semibold">OPEN</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-[6px]">
                                    <p class="font-semibold text-2xl leading-8 text-aktiv-red">Rp{{ number_format($workshop->price, 0, ',', '.') }}</p>
                                    <p class="font-medium text-aktiv-grey">/person</p>
                                </div>
                                <img src="{{ asset('assets/images/icons/arrow-right.svg') }}" class="w-12 h-12 flex shrink-0" alt="icon">
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <footer class="w-full p-[52px] bg-white">
        <div class="flex flex-col w-full max-w-[1176px] mx-auto gap-8">
            <div class="flex flex-col items-center gap-4">
                <img src=""{{asset('assets/images/logos/Logo-blue.svg')}}" class="h-10" alt="logo">
                <p class="font-medium text-aktiv-grey">Ipsum is a company engaged in offline education.</p>
            </div>
            <hr class="border-[#E6E7EB]">
            <div class="grid grid-cols-3 items-center">
                <p class="flex font-medium text-aktiv-grey">© 2024 Workflow Copyright</p>
                <ul class="flex items-center justify-center gap-6">
                    <li class="font-medium text-aktiv-grey text-nowrap hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
                        <a href="#">Workshop</a>
                    </li>
                    <li class="font-medium text-aktiv-grey text-nowrap hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
                        <a href="#">Community</a>
                    </li>
                    <li class="font-medium text-aktiv-grey text-nowrap hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
                        <a href="#">Testimony</a>
                    </li>
                    <li class="font-medium text-aktiv-grey text-nowrap hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
                        <a href="#">About Us</a>
                    </li>
                </ul>
                <ul class="flex items-center justify-end gap-6">
                    <li class="font-medium text-aktiv-grey text-nowrap hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
                        <a href="#">Instagram</a>
                    </li>
                    <li class="font-medium text-aktiv-grey text-nowrap hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
                        <a href="#">Twitter</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

@endsection