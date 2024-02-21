<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // If x-browser-mode header is present and set to false, no need to validate
        if ($this->header('x-browser-mode') !== null && $this->header('x-browser-mode') === 'false') {
            return [];
        }

        return [
            'title' => 'required|string|max:190', // Title max 190 characters
            'campaignType' => 'required|string|in:image,video', // Campaign type must be "image" or "video"
            'upload' => 'required|max:1800|mimes:jpeg,png,gif,mp4,mov,avi', // File upload required, max size 1.8 MB (1800 KB)
            'displayType' => 'required|string|in:banner,side_bar,in_content', // Display type must be one of the specified options
            'redirectLink' => 'nullable|url', // Optional URL format validation, can be null
            'displayOn.*' => 'nullable|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', // Each item in the array must be a valid weekday name, can be null
            'from_start' => 'nullable|date_format:H:i', // Start time format validation, can be null
            'from_end' => 'nullable|date_format:H:i', // End time format validation, can be null
        ];

    }

    public function attributes()
    {
        return [
            'title' => 'Title',
            'campaignType' => 'Campaign Type',
            'upload' => 'Upload',
            'displayType' => 'Display Type',
            'redirectLink' => 'Redirect Link',
            'displayOn' => 'Display On',
            'from.start' => 'Start Time',
            'from.end' => 'End Time',
        ];
    }
}
