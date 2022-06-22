{!! form_start($form)!!}
<div class="row" x-data="createpost">
    <div class="col-md-8">
        {!! form_row($form->title) !!}
        {!! form_row($form->content) !!}

        <div class="card" x-show.transition="form.type === 'video'">
            <h5 class="card-header">{{ Lang::get('administrable-blog::translations.view.post.video_content') }}</h5>
            <div class="card-body">
                <div class="form-group">
                    <label for="video_link">{{ Lang::get('administrable-blog::translations.view.post.video_link') }}</label>
                    <input x-model="form.video_link" type="text" name="video_link" id="video_link" class="form-control" placeholder="https://youtube.com" value="{{ $form->getModel()->video_link }}">
                    <small  class="form-text text-muted">
                       {{ Lang::get('administrable-blog::translations.view.post.video_hint') }} <b>?v=</b>
                    </small>

                </div>
                <iframe x-show="form.video_link.length > 0" :src="embedvideo"  frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

        <x-administrable::seoform :model="$form->getModel()" />

        <div class="form-group">
            <button type="button" @click.prevent="sendForm" class="btn btn-success"> <i class="fa fa-save"></i> Enregistrer</button>
        </div>
    </div>
    <div class="col-md-4">

        <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">{{ Lang::get('administrable-blog::translations.view.post.publication') }}</h3>
            </div>
            <div class="card-body ">
              <div class="text-center py-2">
                  <div>
                    <button @click.prevent="saveDraft"  class="btn btn-success "> <i class="fa fa-save"></i> {{ Lang::get('administrable-blog::translations.view.post.draft') }}</button>

                    <button @click.prevent="sendForm" type="submit"  class="btn  bg-info text-white"> <i class="fas fa-location-arrow"></i>
                        @if($form->getModel()->getKey())
                        {{ Lang::get('administrable-blog::translations.view.post.update') }}
                        @else
                        {{ Lang::get('administrable-blog::translations.view.post.publish') }}
                        @endif
                    </button>
                  </div>
              </div>
              <div class="form-group">
                  <label for="type">{{ Lang::get('administrable-blog::translations.view.post.content_type') }}</label>
                  <select x-model="form.type" @change="changeType"  name="type" id="type" required class="custom-select">
                    @foreach (config('administrable-blog.models.post')::TYPES as $type)
                        <option value="{{ $type['name'] }}" {{ $form->getModel()->type === $type['name'] ? 'selected' : '' }}>{{ $type['label'] }}</option>
                    @endforeach
                  </select>
              </div>

              <hr class="m-0">
              <div class="mt-2">
                 <label for="created_at">{{ Lang::get('administrable-blog::translations.view.post.created_at') }} : </label> &nbsp;&nbsp;&nbsp;
                  <input type="text" name="created_at" id="created_at" class="form-control">
             </div>

             <div class="my-2">
                <button x-show="!form.schedule && !form.published_at" @click.prevent="form.schedule = true" class="btn btn-info btn-block">
                    <i class="fa fa-clock"></i> {{ Lang::get('administrable-blog::translations.view.post.schedule_publication') }}
                </button>
                <div x-show="form.published_at || form.schedule">
                    <hr>
                    <div class="form-group">
                        <label for="published_at">{{ Lang::get('administrable-blog::translations.view.post.schedule_publication_date') }}</label>
                        <input type="text" id="published_at" x-ref="published_at_field"  class="form-control" >
                    </div>
                    {{--  <div class="btn-group float-right">
                        <button @click.prevent="cancelSchedule"  class="btn btn-secondary btn-sm"><i class="fa fa-times"></i> {{ Lang::get('administrable-blog::translations.default.cancel')  }}</button>
                    </div>  --}}
                </div>
             </div>

              <div class="form-group">
                  <label for="online">{{ Lang::get('administrable-blog::translations.view.post.visibility')  }}</label>
                  <select x-model="form.online" name="online" id="online" class="custom-select" required>
                      <option value="0">{{ Lang::get('administrable-blog::translations.view.post.offline') }}</option>
                      <option value="1">{{ Lang::get('administrable-blog::translations.view.post.online') }}</option>
                  </select>
              </div>
              {!! form_row($form->allow_comment) !!}

            </div>
            <!-- /.card-body -->
          </div>
          <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">{{ Lang::get('administrable-blog::translations.view.categories') }}</h3>
            </div>
            <div class="card-body" style="height: 200px; overflow: scroll;">
                <div x-show="!categories.add">
                    <template  x-for="category in categories.list" :key="category.id">
                        <div class="custom-control custom-checkbox">
                            <input @change='selectCategory(category.id)' :checked="checkCategory(category.id)"  type="checkbox"  class="custom-control-input" :id="category.slug">
                            <label class="custom-control-label font-weight-normal" :for="category.slug" x-text="category.name"></label>
                        </div>
                    </template>
                </div>
                <div x-show="categories.add">
                    <div class="form-group">
                        <label for="category-name" class="font-weight-normal">{{ Lang::get('administrable-blog::translations.view.category.name') }}</label>
                        <input type="text" id="category-name" x-model="categories.name"  class="form-control" :class="{'is-invalid': categories.errors.name.length != 0 }" placeholder="Catégorie">
                        <p class="invalid-feedback"  x-text="categories.errors.name[0]"></p>

                    </div>

                    <div class="btn-group d-flex justify-content-end">
                        <button type="button" @click.prevent="cancelAddCategory" class="btn btn-cancel btn-sm"> <i class="fa fa-times"></i> {{ Lang::get('administrable-blog::translations.default.cancel') }}</button>
                        <button type="button" @click.prevent="saveCategory" class="btn btn-success btn-sm"> <i class="fa fa-save"></i> {{ Lang::get('administrable-blog::translations.default.add') }}</button>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button @click.prevent="categories.add = true" class="btn btn-info btn-sm float-right"><i class="fa fa-plus"></i> {{ Lang::get('administrable-blog::translations.view.post.add_category') }}</button>
            </div>
        <!-- /.card-body -->
        </div>
          <div class="card card-secondary collapsed-card">
            <div class="card-header">
                <h3 class="card-title">{{ Lang::get('administrable-blog::translations.view.tags') }}</h3>
            </div>
            <div class="card-body" style="height: 150px; overflow: scroll;">
                <div x-show="!tags.add">
                    <template  x-for="tag in tags.list" :key="tag.id">
                        <div class="custom-control custom-checkbox">
                            <input @change='selectTag(tag.id)' :checked="checkTag(tag.id)"  type="checkbox"  class="custom-control-input" :id="'tag' + tag.slug">
                            <label class="custom-control-label font-weight-normal" :for="'tag' + tag.slug" x-text="tag.name"></label>
                        </div>
                    </template>
                </div>
                <div x-show="tags.add">
                    <div class="form-group">
                        <label for="tag-name" class="font-weight-normal">{{ Lang::get('administrable-blog::translations.view.tag.name') }}</label>
                        <input type="text" id="tag-name" x-model="tags.name"  class="form-control" :class="{'is-invalid': tags.errors.name.length != 0 }" placeholder="Etiquette">
                        <p class="invalid-feedback"  x-text="tags.errors.name[0]"></p>
                    </div>
                    <div class="btn-group d-flex justify-content-end">
                        <button type="button" @click.prevent="cancelAddTag" class="btn btn-cancel btn-sm"> <i class="fa fa-times"></i> {{ Lang::get('administrable-blog::translations.default.cancel') }}</button>
                        <button type="button" @click.prevent="saveTag" class="btn btn-success btn-sm"> <i class="fa fa-save"></i> {{ Lang::get('administrable-blog::translations.default.add') }}</button>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button @click.prevent="tags.add = true" class="btn btn-info btn-sm float-right"><i class="fa fa-plus"></i> {{ Lang::get('administrable-blog::translations.view.post.add_tag') }}</button>
            </div>
        <!-- /.card-body -->
        </div>

        <div class="card">
            <div class="card-body">
                {!! form_row($form->author_id) !!}
            </div>
        </div>
        @imagemanagerfront([
            'label'       => 'Image à la une',
            'model'       => $form->getModel(),
        ])
    </div>
</div>
{!! form_end($form) !!}

<x-administrable::tinymce :model="$form->getModel()" />

<x-administrable::select2 />

<x-administrable::daterangepicker
    fieldname="created_at"
    :model="$form->getModel()"
    :singledatepicker="true"
    opens="right"
    drops="bottom"
/>

<x-administrable::daterangepicker
    selector="#published_at"
    fieldname="published_at"
    :model="$form->getModel()"
    :singledatepicker="true"
    opens="right"
    drops="bottom"
/>


@push('js')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('createpost', () => ({
            // data
            form: {
                schedule: false,
                online: 1,
                type: null,
                published_at: null,
                video_link: '',
            },
            post: @json($form->getModel()),
            categories: {
                add: false,
                name: '',
                validation_required_name: @json(Lang::get('administrable-blog::translations.view.category.validation_required_name')),
                list: @json($categories),
                selected: [],
                errors: { name: [] },
            },
            tags: {
                add: false,
                name: '',
                list: @json($tags),
                validation_required_name: @json(Lang::get('administrable-blog::translations.view.tag.validation_required_name')),
                selected: [],
                errors: { name: [] },
            },
            init(){
                if (this.post.categories.length != 0){
                    this.categories.selected = this.post.categories.map(category => category.id)
                }

                if (this.post.tags.length != 0){
                    this.tags.selected = this.post.tags.map(tag => tag.id)
                }

                this.form.type = this.post.type

                if (this.post.video_link){
                    this.form.video_link = this.post.video_link
                }

                this.form.online = this.post.online ? 1 : 0

                this.handlePublishedAtField()
            },

            // methods
            handlePublishedAtField(){
                const $published_at = $(this.$refs.published_at_field)

                $published_at.on('apply.daterangepicker', (ev, picker) => {
                    this.form.published_at = picker.startDate.format('DD/MM/YYYY HH:mm')
                    this.form.online = 0
                });

                $published_at.on('cancel.daterangepicker', (ev, picker) => {
                    $published_at.val('');
                    this.form.schedule = false
                    this.form.published_at = null
                    this.form.online = 1
                });
            },
            saveDraft(){
                this.appendDataToRequest([
                    { name: 'online', value: 0 },
                    { name: 'published_at', value: null },
                    { name: 'schedule', value: 0 },
                ])
                this.sendForm()
            },
            sendForm(){
                if (this.categories.selected.length != 0){
                    this.appendDataToRequest([
                        { name: 'categories', value: this.categories.selected },
                    ])
                }

                if (this.tags.selected.length != 0){
                    this.appendDataToRequest([
                        { name: 'tags', value: this.tags.selected }
                    ])
                }

                this.appendDataToRequest([
                    { name: 'schedule', value: this.form.schedule ? 1 : 0 },
                ])

                if (this.form.published_at){
                    this.appendDataToRequest([
                        { name: 'published_at', value: this.form.published_at, encode: false },
                    ])
                }

              jQuery(this.currentForm).trigger('submit')
            },
            /** CATEGORIES */
            saveCategory(){
                if (!this.categories.name){
                    this.categories.errors = {name: [this.categories.validation_required_name]}
                    return;
                }

                axios.post('/administrable/extensions/blog/posts/category', { name: this.categories.name })
                    .then(({data}) => {
                        this.categories.list.push(data)

                        this.selectCategory(data.id)

                        this.cancelAddCategory()

                    }).catch((err) => {
                        this.categories.errors = err.response.data.errors;
                    });
            },
            checkCategory(categoryId){
                return this.categories.selected.includes(categoryId)
            },
            selectCategory(categoryId){
                if (this.categories.selected.includes(categoryId)){
                    this.categories.selected = this.categories.selected.filter(category => category != categoryId)
                }else {
                    this.categories.selected = [...this.categories.selected, categoryId]
                }
            },
            changeType(){
                this.selectCategory(this.categories.tv.id)
            }
            ,
            cancelAddCategory(){
                this.categories.add    = false
                this.categories.name   = ''
                this.categories.errors.name = [];
            },
            /** TAGS */
            saveTag(){
                if (!this.tags.name){
                    this.tags.errors = {name: [this.tags.validation_required_name]}
                    return;
                }

                axios.post('/administrable/extensions/blog/posts/tag', { name: this.tags.name })
                    .then(({data}) => {
                        this.tags.list.push(data)

                        this.selectTag(data.id)

                        this.cancelAddTag()

                    }).catch((err) => {
                        this.tags.errors = err.response.data.errors;
                    });
            },
            checkTag(tagId){
                return this.tags.selected.includes(tagId)
            },
            selectTag(tagId){
                if (this.tags.selected.includes(tagId)){
                    this.tags.selected = this.tags.selected.filter(tag => tag != tagId)
                }else {
                    this.tags.selected = [...this.tags.selected, tagId]
                }
            },
            cancelAddTag(){
                this.tags.add    = false
                this.tags.name   = ''
                this.tags.errors.name = [];
            },
            /** HELPERS */
            appendDataToRequest(data){
                data.forEach(item => {
                    const input = document.createElement('input')
                    input.type  = 'hidden'
                    input.name  = item.name
                    input.value = item.encode === false ? item.value : JSON.stringify(item.value)
                    this.currentForm.appendChild(input)
                })
            },
            /** COMPUTED */
            get currentForm(){
                return document.querySelector('form[name={{$form->getModel()->form_name}}]')
            },
            get embedvideo(){
                if (!this.form.video_link){
                    return;
                }
                const link = this.form.video_link.split('?v=').pop()

                return 'https://www.youtube.com/embed/' + link
            },
        }));
    });
</script>
@endpush
