@extends('admin.index')
@section('admin')

<div class="col-12">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">الملف الشخصي</h4>
            <p class="text-muted mb-0">إدارة معلومات حسابك وكلمة المرور</p>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <!-- Profile Picture -->
                    <div class="profile-picture-container position-relative d-inline-block mb-4">
                        <img src="{{ $user->photo ? asset('upload/profile/' . $user->photo) : asset('dist/img/user2-160x160.jpg') }}"
                             class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--primary-dark);"
                             alt="{{ $user->name }}" id="profilePreview">
                        <label for="profilePhoto" class="btn btn-primary btn-icon position-absolute" style="bottom: 5px; right: 5px; cursor: pointer;">
                            <i class="fas fa-camera"></i>
                        </label>
                    </div>

                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>

                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <div class="text-center">
                            <h5 class="mb-0 font-weight-bold" style="color: var(--primary-dark);">{{ \App\Models\Property::count() }}</h5>
                            <small class="text-muted">عقار</small>
                        </div>
                        <div class="text-center">
                            <h5 class="mb-0 font-weight-bold" style="color: var(--primary-dark);">{{ \App\Models\RequestProperty::count() }}</h5>
                            <small class="text-muted">طلب</small>
                        </div>
                        <div class="text-center">
                            <h5 class="mb-0 font-weight-bold" style="color: var(--primary-dark);">{{ \App\Models\Event::count() }}</h5>
                            <small class="text-muted">موعد</small>
                        </div>
                    </div>

                    <hr>

                    <div class="text-right">
                        <p class="mb-2">
                            <i class="fas fa-calendar-alt text-primary ml-2"></i>
                            <span class="text-muted">تاريخ التسجيل:</span>
                            <strong>{{ $user->created_at->format('Y/m/d') }}</strong>
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-clock text-success ml-2"></i>
                            <span class="text-muted">آخر تحديث:</span>
                            <strong>{{ $user->updated_at->diffForHumans() }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Forms -->
        <div class="col-lg-8">
            <!-- Update Profile Information -->
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-user text-primary ml-2"></i>
                        المعلومات الشخصية
                    </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- Hidden file input for photo -->
                        <input type="file" name="photo" id="profilePhoto" class="d-none" accept="image/*" onchange="previewImage(this)">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           value="{{ old('phone', $user->phone ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">العنوان</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           value="{{ old('address', $user->address ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="text-left">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save ml-2"></i> حفظ التغييرات
                            </button>
                        </div>

                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success mt-3">
                                <i class="fas fa-check-circle ml-2"></i>
                                تم تحديث الملف الشخصي بنجاح
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="card mt-4">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-lock text-warning ml-2"></i>
                        تغيير كلمة المرور
                    </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="current_password">كلمة المرور الحالية</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                               id="current_password" name="current_password">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="current_password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('current_password', 'updatePassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">كلمة المرور الجديدة</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                               id="password" name="password">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @error('password', 'updatePassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">تأكيد كلمة المرور</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                               id="password_confirmation" name="password_confirmation">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-left">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-key ml-2"></i> تغيير كلمة المرور
                            </button>
                        </div>

                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success mt-3">
                                <i class="fas fa-check-circle ml-2"></i>
                                تم تغيير كلمة المرور بنجاح
                            </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="card mt-4 border-danger">
                <div class="card-header border-0 bg-danger-light">
                    <h3 class="card-title text-danger">
                        <i class="fas fa-exclamation-triangle ml-2"></i>
                        حذف الحساب
                    </h3>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">
                        بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائياً. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.
                    </p>

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">
                        <i class="fas fa-trash ml-2"></i> حذف الحساب نهائياً
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle ml-2"></i>
                    تأكيد حذف الحساب
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-body">
                    <p class="text-muted mb-3">
                        هل أنت متأكد من رغبتك في حذف حسابك؟ سيتم حذف جميع بياناتك نهائياً. يرجى إدخال كلمة المرور لتأكيد الحذف.
                    </p>

                    <div class="form-group">
                        <label for="delete_password">كلمة المرور</label>
                        <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                               id="delete_password" name="password" placeholder="أدخل كلمة المرور">
                        @error('password', 'userDeletion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash ml-2"></i> حذف الحساب
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Preview profile image
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(button) {
        button.addEventListener('click', function() {
            var targetId = this.getAttribute('data-target');
            var input = document.getElementById(targetId);
            var icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
@endpush
