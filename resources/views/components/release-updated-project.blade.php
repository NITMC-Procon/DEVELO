@props(['data'])
<div>
    <div class="main-title">
        <h1 @php if(mb_strlen($data['title'])>20)echo 'style="zoom:50%;"'@endphp>公開プロジェクトの更新:{{ $data['title'] }}</h1>
    </div>
    <div class='main-default'>
        @if ($data['latest'])
            <p style="margin-bottom:1rem;">プロジェクトは最新です。</p>
            <p class="url"><a href="{{ route('admin.project.manage') }}">プロジェクトの管理に戻る</a></p>
            
        @elseif(!$data['releasable'])
            <p  style="margin-bottom:1rem;">プロジェクトの記入事項に不足があります。プロジェクトの編集を行いますか？</p>
            <p class="url"><a href="{{ route('admin.project.update',['id'=>$data['id']]) }}">プロジェクトの編集</a></p>
            

        @else
            <p style="margin-bottom:1rem;">プロジェクトが更新可能です。以下の内容に同意し、プロジェクトを更新しますか？</p>
            <ul style="line-height: 2rem;margin-bottom:2rem;">
                <li>公開されたプロジェクトはDEVELO内の検索、ランキング等に表示されるようになります。</li>
                <li>一度公開されたプロジェクトは、再度非公開にすることが可能です。非公開にした場合、検索やランキングには表示されなくなります。
                    ただし、既に支援者となったアカウントには、プロジェクトや開発日誌が公開され続けます。</li>
                <li>公開中に行ったプロジェクトの編集は履歴として残され、公開されます。</li>
                <li>原則としてプロジェクトの削除は認められません。ただし、以下の場合は例外的に認められます。
                    <ol>
                        <li>支援者が一人もいない場合</li>
                        <li>プロジェクトの削除要請後、一か月間プロジェクトページに削除に関する表示を行い、有効な異議申し立てがない場合。</li>
                    </ol>
                </li>
            </ul>

            <p style="text-align: center;"><a href="{{ route('manage.project.release',['id'=>$data['id']]) }}" >プロジェクトを更新する</a></p>
        @endif

    </div>
</div>
