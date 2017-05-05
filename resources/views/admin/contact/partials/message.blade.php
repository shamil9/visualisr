<div class="column is-6">
    <div class="box">
        <article class="media">
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>{{ $message->name }}</strong>
                        <small>{{ $message->created_at->diffForHumans() }}</small>
                        <br>
                        {{ $message->body }}
                    </p>
                    @can('manage', App\SupportTicket::class)
                        <nav class="level is-mobile">
                            <div class="level-left">
                                <a class="level-item" href="mailto:{{ $message->email }}">
                                    <span class="icon is-small"><i class="fa fa-reply"></i></span>
                                </a>
                                <form ref="{{ $message->id }}" method="post"
                                      action="{{ route('contact.destroy', $message) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <a @click.prevent="$emit('showModalEvent', {{ $message->id }})" class="level-item" href="#">
                                        <span class="icon is-small"><i class="fa fa-trash"></i></span>
                                    </a>
                                </form>
                            </div>
                        </nav>
                    @endcan
                </div>
            </div>
        </article>
    </div>
</div>
