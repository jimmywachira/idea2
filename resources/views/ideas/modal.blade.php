<x-modal name="idea-form" title="Idea">
    <div class="p-1">
        <div class="text-center mb-6">
            <h3 class="text-2xl font-bold" x-text="isEdit ? 'Edit Idea' : 'New Idea'"></h3>
            <p class="text-sm text-base-content/60" x-text="isEdit ? 'Update existing idea details' : 'Share your thoughts with the team'"></p>
        </div>

        <form 
            x-data="{ 
                isEdit: false,
                id: null,
                title: '',
                description: '',
                status: 'pending',
                newLink: '',
                links: [],
                newStep: '',
                steps: [],
                isSubmitting: false,
                action: '{{ route('ideas.store') }}',

                init() {
                    this.$watch('isEdit', val => {
                        this.action = val ? `/ideas/${this.id}` : '{{ route('ideas.store') }}';
                    });
                },

                receiveEvent(detail) {
                    if (detail.idea) {
                        this.isEdit = true;
                        this.id = detail.idea.id;
                        this.title = detail.idea.title;
                        this.description = detail.idea.description;
                        this.status = detail.idea.status;
                        this.links = detail.idea.links || [];
                        // Map step objects to strings if they exist, otherwise empty array
                        this.steps = detail.idea.steps ? detail.idea.steps.map(s => s.description) : [];
                    } else {
                        this.isEdit = false;
                        this.reset();
                    }
                    $dispatch('open-modal', { name: 'idea-form' });
                },

                reset() {
                    this.id = null;
                    this.title = '';
                    this.description = '';
                    this.status = 'pending';
                    this.links = [];
                    this.steps = [];
                    this.newLink = '';
                    this.newStep = '';
                }
            }" 
            @open-idea-form.window="receiveEvent($event.detail)"
            @submit="isSubmitting = true"
            :action="action" 
            method="POST" 
            class="space-y-5">
            
            @csrf
            <template x-if="isEdit">
                <input type="hidden" name="_method" value="PUT">
            </template>
            
            <!-- Title -->
            <div class="form-control w-full">
                <label class="label font-medium"><span class="label-text">Title</span></label>
                <input type="text" name="title" x-model="title" placeholder="e.g., Dark Mode Support" class="input input-bordered w-full focus:input-primary" required />
                <x-form.error name="title" />
            </div>

            <!-- Status -->
            <div class="form-control w-full"> 
                <label class="label font-medium"><span class="label-text">Status</span></label>
                <div class="grid grid-cols-3 gap-2">
                    @foreach(\App\IdeaStatus::cases() as $status)
                        <button type="button" @click="status = '{{ $status->value }}'" class="btn btn-sm h-10 capitalize" :class="status === '{{ $status->value }}' ? 'btn-primary' : 'btn-outline border-base-300 text-base-content/70 hover:bg-base-200 hover:border-base-300'">{{ $status->label() }}</button>
                    @endforeach
                    <input type="hidden" name="status" :value="status" />
                </div>
                <x-form.error name="status" />
            </div>

            <!-- Description -->
            <div class="form-control w-full">
                <label class="label font-medium"><span class="label-text">Description</span></label>
                <textarea name="description" x-model="description" class="textarea textarea-bordered h-24 focus:textarea-primary" placeholder="Describe the functionality..."></textarea>
                <x-form.error name="description" />
            </div>

            <!-- Dynamic Sections (Links & Steps) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Links -->
                <div class="bg-base-200/50 rounded-xl p-4 border border-base-200">
                    <label class="label font-medium pt-0"><span class="label-text flex items-center gap-2"><ion-icon name="link"></ion-icon> Links</span></label>
                    <div class="space-y-2">
                        <template x-for="(link, index) in links" :key="index"><div class="flex gap-2"><input type="text" name="links[]" x-model="links[index]" class="input input-sm input-bordered w-full" /><button type="button" @click="links.splice(index, 1)" class="btn btn-sm btn-square btn-ghost text-error"><ion-icon name="close"></ion-icon></button></div></template>
                        <div class="flex gap-2"><input x-model="newLink" @keydown.enter.prevent="if(newLink.trim().length > 0) { links.push(newLink.trim()); newLink = ''; }" type="url" placeholder="https://..." class="input input-sm input-bordered w-full" /><button type="button" @click="links.push(newLink.trim()); newLink = ''" :disabled="newLink.trim().length === 0" class="btn btn-sm btn-square btn-primary"><ion-icon name="add"></ion-icon></button></div>
                    </div>
                </div>

                <!-- Steps -->
                <div class="bg-base-200/50 rounded-xl p-4 border border-base-200">
                    <label class="label font-medium pt-0"><span class="label-text flex items-center gap-2"><ion-icon name="list"></ion-icon> Steps</span></label>
                    <div class="space-y-2">
                        <template x-for="(step, index) in steps" :key="index"><div class="flex gap-2"><input type="text" name="steps[]" x-model="steps[index]" class="input input-sm input-bordered w-full" /><button type="button" @click="steps.splice(index, 1)" class="btn btn-sm btn-square btn-ghost text-error"><ion-icon name="close"></ion-icon></button></div></template>
                        <div class="flex gap-2"><input x-model="newStep" @keydown.enter.prevent="if(newStep.trim().length > 0) { steps.push(newStep.trim()); newStep = ''; }" type="text" placeholder="Step description..." class="input input-sm input-bordered w-full" /><button type="button" @click="steps.push(newStep.trim()); newStep = ''" :disabled="newStep.trim().length === 0" class="btn btn-sm btn-square btn-primary"><ion-icon name="add"></ion-icon></button></div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                    <label class="label" for="image">Featured Image</label>
                    <input id="image" name="image" type="file" accept="image/*" class="input" />
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            <div class="modal-action mt-6">
                <button type="button" @click="show = false" class="btn btn-ghost border border-base-300" :disabled="isSubmitting">Cancel</button>
                <button 
                    type="submit" 
                    class="btn btn-primary px-8" 
                    :disabled="isSubmitting"
                    x-text="isSubmitting ? (isEdit ? 'Updating...' : 'Creating...') : (isEdit ? 'Update Idea' : 'Create Idea')">
                </button>
            </div>
        </form>
    </div>    
</x-modal>
