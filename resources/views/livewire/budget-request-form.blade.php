<div>
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
        
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">AlergioCureHMS</span>
                            </a>
                        </div><!-- End Logo -->
        
                        <div class="card mb-3" style="width: 150%">
        
                           <div class="card-body p-4">
                            <div class="form-group">
                                <h1 class="text-center">Budget Request Form</h1>
                                <label>Requestor</label>
                                <input wire:model='requestor' type="text" class="form-control">
                                @error('requestor') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                <label>Department</label>
                                <select wire:model="department" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="HR">HR</option>
                                    <option value="Logistics">Logistics</option>
                                    <option value="Core">Core</option>
                                    <option value="Finance">finance</option>
                                </select>
                                @error('department') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                <label>Proposed Amount</label>
                                <input wire:model='amount' type="number" class="form-control">
                                @error('amount') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                <label>Description</label>
                                <textarea wire:model='description' rows="5" class="form-control"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                <label>Attachment (Optional)</label>
                                <input wire:model='file_name' type="file" class="form-control">
                                <button wire:click="sendRequest" class="btn btn-primary form-control mt-3" wire:loading.class="bg-gray">Send
                                    <div wire:loading wire:target="sendRequest" class="spinner-border" role="status">
                                        <span class="sr-only">Uploading...</span>
                                    </div>
                                </button>

                                @error('file_name') <span class="text-danger">{{ $message }}</span> <br> @enderror
                            </div>
                           </div>
                        </div>

                    </div>
                </div>
            </div>
        
        </section>
</div>
