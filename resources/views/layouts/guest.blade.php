<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Seed Savers Club') }}</title>
		@stack('meta')
		<!-- Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

		<!-- Styles -->
		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
		@livewireStyles
		<!-- Scripts -->
		<script src="{{ mix('js/app.js') }}" defer></script>
		@stack('scripts')
	</head>
	<body>
		<div class="font-sans text-gray-900 mt-24 antialiased">
			<div class="fixed top-0 w-screen z-10 bg-white">@livewire('navigation-menu')</div>
			<div class="z-0">{{ $slot }}</div>
		</div>
		@livewireScripts
		@if(App::environment('production'))
		<script type="text/javascript">
		(function(f,b){if(!b.__SV){var e,g,i,h;window.mixpanel=b;b._i=[];b.init=function(e,f,c){function g(a,d){var b=d.split(".");2==b.length&&(a=a[b[0]],d=b[1]);a[d]=function(){a.push([d].concat(Array.prototype.slice.call(arguments,0)))}}var a=b;"undefined"!==typeof c?a=b[c]=[]:c="mixpanel";a.people=a.people||[];a.toString=function(a){var d="mixpanel";"mixpanel"!==c&&(d+="."+c);a||(d+=" (stub)");return d};a.people.toString=function(){return a.toString(1)+".people (stub)"};i="disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking start_batch_senders people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
		for(h=0;h<i.length;h++)g(a,i[h]);var j="set set_once union unset remove delete".split(" ");a.get_group=function(){function b(c){d[c]=function(){call2_args=arguments;call2=[c].concat(Array.prototype.slice.call(call2_args,0));a.push([e,call2])}}for(var d={},e=["get_group"].concat(Array.prototype.slice.call(arguments,0)),c=0;c<j.length;c++)b(j[c]);return d};b._i.push([e,f,c])};b.__SV=1.2;e=f.createElement("script");e.type="text/javascript";e.async=!0;e.src="undefined"!==typeof MIXPANEL_CUSTOM_LIB_URL?
		MIXPANEL_CUSTOM_LIB_URL:"file:"===f.location.protocol&&"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//)?"https://cdn.mxpnl.com/libs/mixpanel-2-latest.min.js":"//cdn.mxpnl.com/libs/mixpanel-2-latest.min.js";g=f.getElementsByTagName("script")[0];g.parentNode.insertBefore(e,g)}})(document,window.mixpanel||[]);

		// Enabling the debug mode flag is useful during implementation,
		// but it's recommended you remove it for production
		mixpanel.init('356d40252226119fec46e32e2270c51f'); 
		mixpanel.track('Page visited');
		tracklinkclicksauto=(event)=>{
				console.log("auto tracking", event);
				mixpanel.track_links('a','Link Clicked');
			}
		let alinks=document.querySelectorAll('a');
		alinks.forEach((a)=>{
			if(a.onclick==null){
				a.addEventListener('click',tracklinkclicksauto);
			}
		});
		</script>
		<!-- Hotjar Tracking Code for seedsaversclub.com -->
		<script>
			(function(h,o,t,j,a,r){
				h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
				h._hjSettings={hjid:2412966,hjsv:6};
				a=o.getElementsByTagName('head')[0];
				r=o.createElement('script');r.async=1;
				r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
				a.appendChild(r);
			})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
		</script>
		@endif
		<script type="text/javascript">
			window.onload = function() {
				var iframes = document.getElementsByTagName('iframe');
				for (var i = 0; i < iframes.length; ++i) {
					if (iframes[i]) {
						var src = iframes[i].getAttribute('src');
						if(src){
							if (src.indexOf('youtube.com/embed') != -1) {
								iframes[i].style.width='100%';
								iframes[i].style.height=0.5625*iframes[i].offsetWidth+'px';
							}
						}
					}
				}
			}
		</script>
	</body>
</html>
