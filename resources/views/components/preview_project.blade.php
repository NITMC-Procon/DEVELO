@props(["project_data"])

<div class="preview" style="width: 100%;">
    @php
        echo $project_data["intro_converted"];
    @endphp
</div>
