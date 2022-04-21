<div class="w-screen sm:max-w-3xl mx-auto flex justify-between bg-primary text-xl text-black">
  @if(url()->previous()!=url()->current())
  <a class="px-4 py-4" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a>
  @endif
  <a href="/e2e" class="px-4 py-4"><i class="fas fa-home"></i></a>  
</div>