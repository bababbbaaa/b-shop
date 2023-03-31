<div class="mt-0">
    <h5 class="mb-4 text-sm 2xl:text-md font-bold">{{$filter->title()}}</h5>
    <div class="flex items-center justify-between gap-3 mb-2">
        <span class=" text-xxs font-medium">От, ₽</span>
        <span class=" text-xxs font-medium">До, ₽</span>
    </div>
    <div class="flex items-center gap-3">

        <input type="number"
               id="{{$filter->id('from')}}"
               name="{{$filter->name('from')}}"
               class="w-full h-12 w-full h-14 px-4 rounded-lg border border-[#85552d] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#85552d] outline-none transition text-xxs md:text-xs font-semibold"
               value="{{$filter->requestValue('from', 0)}}" placeholder="От">
        <span class=" text-sm font-medium">–</span>

        <input type="number"
               name="{{$filter->name('to')}}"
               id="{{$filter->id('to')}}"
               class="w-full h-14 px-4 rounded-lg border border-[#85552d] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#85552d] outline-none transition text-xxs md:text-xs font-semibold"
               value="{{$filter->requestValue('to', 100000)}}" placeholder="До">
    </div>
</div>
