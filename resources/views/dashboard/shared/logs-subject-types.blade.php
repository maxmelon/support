@if ($subject == 'category') "{{ $activities->find($activity->subject_id)->name }}"
@elseif ($subject == 'question') "{{ $questions->find($activity->subject_id)->question }}"
@else ($subject == 'user') "{{ $users->find($activity->subject_id)->name }}"
@endif