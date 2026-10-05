@extends('layouts.admin')

@section('title', $faq->exists ? 'Edit FAQ' : 'Add FAQ')

@section('content')
    <form method="POST" action="{{ $faq->exists ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}" class="card">
        @csrf
        @if($faq->exists) @method('PUT') @endif
        <div class="form-grid">
            <div class="field">
                <label for="question">Question (English)</label>
                <input type="text" id="question" name="question" value="{{ old('question', $faq->question) }}" required>
                @error('question')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="question_ur">Question (Urdu)</label>
                <input type="text" id="question_ur" name="question_ur" class="ur" dir="rtl" value="{{ old('question_ur', $faq->question_ur) }}">
            </div>
            <div class="field">
                <label for="answer">Answer (English)</label>
                <textarea id="answer" name="answer" rows="6" required>{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="answer_ur">Answer (Urdu)</label>
                <textarea id="answer_ur" name="answer_ur" rows="6" class="ur" dir="rtl">{{ old('answer_ur', $faq->answer_ur) }}</textarea>
            </div>
            <div class="field">
                <label for="sort_order">Display order</label>
                <input type="number" min="0" id="sort_order" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}">
            </div>
            <div class="field">
                <label>&nbsp;</label>
                <label class="check"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $faq->is_active))> Visible on website</label>
            </div>
        </div>
        <div class="form-actions">
            <button class="btn">Save FAQ</button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-light">Cancel</a>
        </div>
    </form>
@endsection
