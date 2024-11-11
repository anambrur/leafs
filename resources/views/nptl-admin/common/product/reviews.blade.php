<?php
$editReviewPermission = SM::check_this_method_access('products', 'edit_review');
$reviewStatusUpdatePermission = SM::check_this_method_access('products', 'review_status_update');
$deleteReviewPermission = SM::check_this_method_access('products', 'destroy');
$canPerformActions = $editReviewPermission || $deleteReviewPermission;
?>

@if ($reviews)
    <?php $sl = 1; ?>
    @foreach ($reviews as $review)
        <tr id="tr_{{ $review->id }}">
            <td>{{ $sl }}</td>
            <td>{{ $review->product->title ?? 'N/A' }}</td>
            <td>{{ $review->rating }}</td>
            <td>
                {{ strlen($review->description) > 500 ? substr(strip_tags($review->description), 0, 500) . '...' : $review->description }}
            </td>
            <td>{{ $review->user->username ?? '' }}</td>

            @if ($reviewStatusUpdatePermission)
                <td class="text-center">
                    <select class="form-control change_status"
                        route="{{ config('constant.smAdminSlug') }}/products/review_status_update"
                        post_id="{{ $review->id }}">
                        <option value="1" {{ $review->status == 1 ? 'selected' : '' }}>Published</option>
                        <option value="2" {{ $review->status == 2 ? 'selected' : '' }}>Pending</option>
                        <option value="3" {{ $review->status == 3 ? 'selected' : '' }}>Canceled</option>
                    </select>
                </td>
            @endif

            @if ($canPerformActions)
                <td class="text-center">
                    @if ($editReviewPermission)
                        <a href="{{ url(config('constant.smAdminSlug') . '/products/reply_review/' . $review->id) }}"
                            title="Reply" class="btn btn-xs btn-default" style="display: none;">
                            <i class="fa fa-reply"></i>
                        </a>
                        <a href="{{ url(config('constant.smAdminSlug') . '/products/edit_review/' . $review->id) }}"
                            title="Edit" class="btn btn-xs btn-default" style="display: none;">
                            <i class="fa fa-pencil"></i>
                        </a>
                    @endif

                    @if ($deleteReviewPermission)
                        <a href="{{ url(config('constant.smAdminSlug') . '/products/delete_review/' . $review->id) }}"
                            title="Delete" class="btn btn-xs btn-default delete_data_row"
                            delete_message="Are you sure to delete this blog review?"
                            delete_row="tr_{{ $review->id }}">
                            <i class="fa fa-times"></i>
                        </a>
                    @endif
                </td>
            @endif
        </tr>
        <?php $sl++; ?>
    @endforeach
@endif
