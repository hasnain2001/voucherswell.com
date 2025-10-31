  @foreach ($stores as $store)
                                <tr id="store-row-{{ $store->id }}">
                                    <td><input type="checkbox" class="form-check-input select-checkbox" name="selected[]" value="{{ $store->id }}"></td>
                                    <td>{{ $store->id }}</td>
                                    <td>{{ $store->name }}</td>
                                    <td>{{ $store->slug }}</td>
                                    <td><img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->name }}" class="img-thumbnail"></td>
                                    <td>{{ $store->category->name ?? 'N/A' }}</td>
                                    <td>{{ $store->network->title ?? 'N/A' }}</td>
                                    <td>{{ $store->language->name ?? 'N/A' }}</td>
                                    <td>
                                        @if($store->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($store->user)
                                            <small>Created by: {{ $store->user->name }}</small><br>
                                        @endif
                                        <small>Created: {{ $store->created_at->diffForHumans() }}</small><br>
                                        @if ($store->updatedby)
                                            <small>Updated by: {{ $store->updatedby->name }}</small> <br>
                                        @endif
                                        <small>Updated: {{ $store->updated_at->diffForHumans() }}</small>
                                    </td>
                                    <td class="d-flex gap-1">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.store.edit', $store->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-3 px-2"
                                           title="Edit Store">
                                            <i class="mdi mdi-pencil-outline"></i>
                                        </a>

                                        <!-- View -->
                                        <a href="{{ route('admin.store.show', $store->id) }}"
                                           class="btn btn-sm btn-outline-success rounded-3 px-2"
                                           title="View Store">
                                            <i class="fa fa-tag" aria-hidden="true"></i>
                                        </a>
                                         <a href="{{ route('store.detail', $store->id) }}"
                                           class="btn btn-sm btn-outline-success rounded-3 px-2"
                                           title="View Store">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </a>

                                        <!-- Delete -->
                                        <a href="javascript:void(0);"
                                           class="btn btn-sm btn-outline-danger rounded-3 px-2 delete-store-btn"
                                           data-id="{{ $store->id }}"
                                           title="Delete Store">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
