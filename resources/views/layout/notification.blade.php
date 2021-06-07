@if(isset($message)or session()->has('message') or session()->has('errormessage'))
    <link rel="stylesheet" type="text/css" href="css/notification.css" />
<div id="hellobar-bar" class="regular closable" @if(session()->has('errormessage')) style="background-color: #d39e00"@endif>
    <div class="hb-content-wrapper">
        <div class="hb-text-wrapper">
            <div class="hb-headline-text">
                <p><span>@if(isset($message))
{{$message}}
@endif
                @if(session()->has('message'))
                        {{ session()->get('message') }}
                @endif
                        @if(session()->has('errormessage'))
                            {{ session()->get('errormessage') }}
                        @endif
                </span></p>
            </div>
        </div>
    </div>
    <div class="hb-close-wrapper">
        <a href="javascript:void(0);" class="icon-close" onClick="$('#hellobar-bar').fadeOut()">&#10006;</a>
    </div>
</div>
<?php unset($message); ?>
@endif
