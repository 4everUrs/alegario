<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="row">
        <div class="col-xl-4">
    
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
    
                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    <h2>{{Auth::user()->name}}</h2>
                    @if (Auth::user()->user_level == '0')
                   <h3>Administrator</h3>
                    @else
                    <h3>Manager</h3>
                    @endif
                    <div class="social-links mt-2">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
    
        </div>
    
        <div class="col-xl-8">
    
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" wire:ignore>
    
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Overview</button>
                        </li>
    
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>
    
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                                Password</button>
                        </li>
    
                    </ul>
                    <div class="tab-content pt-2">
    
                        <div class="tab-pane fade show active profile-overview" id="profile-overview" wire:ignore.self>
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic">Alegario Super Admin</p>
    
                            <h5 class="card-title">Profile Details</h5>
    
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8">{{Auth::user()->name}}</div>
                            </div>
    
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Company</div>
                                <div class="col-lg-9 col-md-8">Alegario Cure Medical</div>
                            </div>
    
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Job</div>
                                @if (Auth::user()->user_level == '0')
                                    <div class="col-lg-9 col-md-8">Administrator</div>
                                @else
                                    <div class="col-lg-9 col-md-8">Manager</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{Auth::user()->email}}</div>
                            </div>
    
                        </div>
    
                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit" wire:ignore.self>
    
                            <!-- Profile Edit Form -->
                            <form wire:submit.prevent="save">
                              

                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        <img src="assets/img/profile-img.jpg" alt="Profile">
                                        <div class="pt-2">
                                            <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i
                                                    class="bi bi-upload"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                                                    class="bi bi-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="fullName" type="text" class="form-control" id="fullName"
                                             wire:model='name'>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="username" type="text" class="form-control" id="fullName"
                                             wire:model='username'>
                                    </div>
                                </div>
    
    
                                <div class="row mb-3">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="company" type="text" class="form-control" id="company"
                                            value="Alegario Cure Medical" disabled>
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                    <div class="col-md-8 col-lg-9">
                                        @if (Auth::user()->user_level == '0')
                                            <input name="job" type="text" class="form-control" id="Job" value="Admininstrator" disabled>
                                        @else
                                            <input name="job" type="text" class="form-control" id="Job" value="Manager" disabled>
                                        @endif
                                    </div>
                                </div>
    
    
                                <div class="row mb-3">
                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="phone" type="text" class="form-control" id="Phone"
                                           wire:model="phone">
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email"
                                            wire:model="email">
                                    </div>
                                </div>
    
    
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
    
                        </div>
      
                        <div class="tab-pane fade pt-3" id="profile-change-password" wire:ignore.self>
                            <!-- Change Password Form -->
                            <form wire:submit.prevent="changePassword">
                                <div class="row mb-3">
                                    <label for="old_password" class="col-md-4 col-lg-3 col-form-label">Current
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input wire:model='old_password' id="old_password" name="old_password" type="password" class="form-control" autocomplete="current-password">
                                        @error('old_password') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input wire:model="new_password" id="new_password" name="new_password" type="password" class="form-control" autocomplete="new_password">
                                        @error('new_password') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                        Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input wire:model="confirm_password" id="confirm_password" name="confirm_password" type="password" class="form-control" autocomplete="confirm_password">
                                        @error('confirm_password') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    </div>
                                </div>
    
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                                @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                @endif
                            </form><!-- End Change Password Form -->
    
                        </div>
    
                    </div><!-- End Bordered Tabs -->
    
                </div>
            </div>
    
        </div>
    </div>
</div>
