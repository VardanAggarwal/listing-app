<div class="bg-green-400 my-5 px-6 py-4 rounded-lg shadow-lg border border-green-500 grid">
    @if($type=='story')
        <h1 class="text-xl">{{__('ui.add_story_card_text')}}</h1>
        <a href="/stories/new" class="mt-3 mx-auto"><x-jet-button>{{__('ui.add_story_button')}}</x-jet-button></a>
    @elseif($type=='listing')
        <h1 class="text-xl">{{__('ui.add_listing_card_text')}}</h1>
        <a href="/listings/new" class="mt-3 mx-auto"><x-jet-button>{{__('ui.add_listing_button')}}</x-jet-button></a>
    @else
        <h1 class="text-xl">{{__('ui.add_interest_card_text')}}</h1>
        <a href="/profile/interests" class="mt-3 mx-auto"><x-jet-button>{{__('ui.add_interest_button')}}</x-jet-button></a>
    @endif
</div>