<div class="space-y-6">
    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.16em] text-indigo-600">Section overview</p>
                <h2 class="mt-2 text-2xl font-semibold text-slate-900">{{ $section->section_code }}</h2>
                <p class="mt-1 text-sm text-slate-500">{{ $section->campus }} · {{ $section->program }} · {{ $section->year_level }} · {{ $section->term }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="rounded-full border border-slate-300 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700">{{ $section->school_year }}</span>
                @if(isset($teacher))
                    <span class="rounded-full border border-slate-300 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700">Teacher: {{ $teacher->first_name }} {{ $teacher->last_name }}</span>
                @endif
                <span class="rounded-full border border-slate-300 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700">{{ $section->students->count() }} students</span>
            </div>
        </div>
    </div>

    @if($section->students->isEmpty())
        <div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-6 text-center text-sm text-slate-600">
            No students are currently assigned to this section.
        </div>
    @else
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                <p class="text-sm font-semibold text-slate-900">Assigned students</p>
                <p class="mt-1 text-sm text-slate-500">Review the student roster for this section.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                    <thead class="bg-slate-100 text-slate-500">
                        <tr>
                            <th class="px-6 py-3 font-semibold uppercase tracking-[0.12em]">Student ID</th>
                            <th class="px-6 py-3 font-semibold uppercase tracking-[0.12em]">Name</th>
                            <th class="px-6 py-3 font-semibold uppercase tracking-[0.12em]">Program</th>
                            <th class="px-6 py-3 font-semibold uppercase tracking-[0.12em]">Year Level</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($section->students as $student)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-slate-700">{{ $student->student_id }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $student->program }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $student->year_level }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
