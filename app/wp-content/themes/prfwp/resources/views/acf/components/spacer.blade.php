@set($hide_on, get_sub_field('hidden') ? ' ' . get_sub_field('hidden') : '')
<div class="acfm-{{App::layout()}}{{Page::padding()}}{{$hide_on}}"></div>
