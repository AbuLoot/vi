@if (isset($contacts))
	<p>
		@if (isset($contacts->phone) AND $contacts->phone) 
			<span>{{ $contacts->phone }}</span>
			<span class="soc-icon-container">
				@if ($contacts->telegram == 'on') 
					<i class="soc-icon-telegram"></i> 
				@endif
				@if ($contacts->whatsapp == 'on') 
					<i class="soc-icon-whatsapp"></i> 
				@endif
				@if ($contacts->viber == 'on') 
					<i class="soc-icon-viber"></i> 
				@endif
			</span>

		@endif

		@if (isset($contacts->phone2) AND $contacts->phone2) 
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<span>{{ $contacts->phone2 }}</span>
			<span class="soc-icon-container">
				@if ($contacts->telegram2 == 'on') 
					<i class="soc-icon-telegram"></i> 
				@endif
				@if ($contacts->whatsapp2 == 'on') 
					<i class="soc-icon-whatsapp"></i> 
				@endif
				@if ($contacts->viber2 == 'on') 
					<i class="soc-icon-viber"></i> 
				@endif
			</span>
		@endif

	</p>
@endif
