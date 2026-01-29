<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QConnect - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --bg: #f8fafc;
            --card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --side-width: 280px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        .side-dash {
            width: var(--side-width);
            background: white;
            border-right: 1px solid #e2e8f0;
            padding: 2rem 1.5rem;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
            z-index: 1000;
        }

        .side-logo {
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--primary);
            text-decoration: none;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-menu { flex-grow: 1; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.9rem 1rem;
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            font-family: inherit;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

        .nav-link.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }

        main {
            margin-left: var(--side-width);
            flex: 1;
            min-width: 0;
        }

        header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            padding: 1rem 5%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #e2e8f0;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .question-card {
            background: var(--card);
            border-radius: 20px;
            padding: 1.8rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .question-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .avatar {
            width: 45px; height: 45px;
            background: #eef2ff;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .card-footer {
            display: flex; justify-content: space-between; align-items: center;
            margin-top: 1.5rem; padding-top: 1.2rem; border-top: 1px solid #f1f5f9;
        }

        .btn-star {
            background: #fff; border: 1px solid #e2e8f0;
            padding: 8px 16px; border-radius: 10px;
            cursor: pointer; color: var(--text-muted);
            font-weight: 600; transition: 0.2s;
            display: flex; align-items: center; gap: 8px;
        }

        .btn-star:hover { border-color: #fcd34d; color: #f59e0b; background: #fffbeb; }

        .favoris-container {
            background: white; border-radius: 24px; padding: 2rem;
            border: 1px solid #e2e8f0; display: none;
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fav-card {
            display: flex; align-items: center; gap: 15px; padding: 1.2rem;
            background: var(--bg); border-radius: 16px; margin-top: 1rem;
            border: 1px solid transparent; transition: 0.2s;
        }

        .fav-card:hover { border-color: var(--primary-light); background: white; }

        .modal { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 2000; }
        .modal-content {
            background: white; margin: 5vh auto; padding: 2.5rem;
            border-radius: 24px; width: 90%; max-width: 500px;
        }

        .btn-ask {
            background: var(--primary); color: white; padding: 0.8rem 1.5rem;
            border-radius: 12px; font-weight: 700; border: none; cursor: pointer;
            transition: 0.3s; display: flex; align-items: center; gap: 10px;
        }
        .btn-ask:hover { background: var(--primary-dark); transform: scale(1.02); }

        .btn-submit { background: var(--primary); color: white; border: none; padding: 14px; border-radius: 12px; width: 100%; font-weight: 700; cursor: pointer; }

        .fav-card-styled {
            border-left: 5px solid #fcd34d !important;
        }

        .btn-remove {
            background: #fff1f2;
            color: #ef4444;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-remove:hover {
            background: #ef4444;
            color: white;
        }

        .fav-replies-box {
            background: #f8fafc;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #edf2f7;
        }

        .replies-list {
            max-height: 120px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .mini-reply {
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
        }

        .mini-reply:last-child { border-bottom: none; }

        .reply-text { font-size: 0.85rem; color: var(--text-main); line-height: 1.4; }

        .reply-author {
            font-size: 1rem;
            color: var(--primary);
            font-weight: 600;
            margin-top: 3px;
        }

        .replies-list::-webkit-scrollbar { width: 4px; }
        .replies-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .header-actions{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .search-box {
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            color: var(--text-muted);
            transition: 0.3s;
            pointer-events: none;
        }

        .search-box input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            background: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            color: var(--text-main);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .search-box input::placeholder {
            color: #94a3b8;
        }

        .search-box input:hover {
            background: #eef2ff;
        }

        .search-box input:focus {
            outline: none;
            background: white;
            border-color: var(--primary-light);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.1);
        }

        .search-box input:focus + i,
        .search-box:focus-within i {
            color: var(--primary);

        }
        .btn-search-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .btn-search-submit:hover {
            background: var(--primary-dark);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            transform: translateY(-1px);
        }

        .btn-search-submit:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

@auth
    <aside class="side-dash">
        <a href="#" class="side-logo">
            <i class="fa-solid fa-compass"></i> QConnect
        </a>

        <nav class="nav-menu">
            <button onclick="showSection('discover')" class="nav-link active" id="link-discover">
                <i class="fa-solid fa-house"></i> Découvrir
            </button>
            <button onclick="showSection('favoris')" class="nav-link" id="link-favoris">
                <i class="fa-solid fa-star"></i> Mes Favoris
            </button>
        </nav>

        <div class="user-profile" style="margin-top: auto; padding-top: 1rem; border-top: 1px solid #f1f5f9;">
            <div class="nav-link" style="margin-bottom:0; cursor: default; background: none;">
                <i class="fa-solid fa-user-circle"></i>
                <span style="font-size: 0.9rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    {{ Auth::user()->fullname }}
                </span>
            </div>
            <a href="/logout" class="nav-link" style="color: #ef4444;">
                <i class="fa-solid fa-power-off"></i> Déconnexion
            </a>
        </div>
    </aside>

    <main>
        <header>
            <button onclick="openModal()" class="btn-ask">
                <i class="fa-solid fa-plus-circle"></i> Poser une question
            </button>
        </header>

        <div class="container" id="mainContainer">
            <div class="header-actions">
                <h1 id="pageTitle" style="font-size: 1.8rem; font-weight: 800; letter-spacing: -0.025em; margin-bottom: 2rem;">Découvrir</h1>
                <form method="GET" action="{{ route('affichage') }}">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Rechercher une question..." name="search">
                        <button type="submit" class="btn-search-submit">Chercher</button>
                    </div>
                </form>
            </div>

            <div id="questionsFeed">
                @foreach($questions as $question)
                    <div class="question-card">
                        <div class="question-header">
                            <div class="avatar"><i class="fa-solid fa-user"></i></div>
                            <div class="user-info">
                                <h4 style="margin:0">{{ $question->user->fullname ?? 'Anonyme' }}</h4>
                                <span style="font-size: 0.75rem; color: var(--text-muted)">{{ $question->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="question-content">
                            <h2 style="font-size: 1.3rem; margin: 10px 0;">{{ $question->titre }}</h2>
                            <p style="color: var(--text-muted); line-height: 1.6;">{{ Str::limit($question->description, 150) }}</p>
                        </div>

                        <div class="card-footer">
                            <span style="font-size: 0.85rem; color: var(--primary); font-weight: 600;">
                                <i class="fa-regular fa-comment"></i> {{ $question->reponses->count() }} réponses
                            </span>

                            <form method="POST" action="{{ route('favoris.store') }}">
                                @csrf
                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                <button type="submit" class="btn-star">
                                    <i class="fa-regular fa-star"></i> Sauvegarder
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="favorisSection" class="favoris-container">
                <div class="section-header">
                    <h2 style="margin: 0; font-weight: 800;">Mes Favoris</h2>
                    <p style="color: var(--text-muted); margin: 5px 0 20px 0;">Questions sauvegardées pour plus tard.</p>
                </div>
                <div class="favoris-grid">
                    @foreach($favoris as $fav)
                        <div class="question-card fav-card-styled"> <div class="question-header">
                                <div class="avatar" style="background: #fef3c7; color: #d97706;">
                                    <i class="fa-solid fa-bookmark"></i>
                                </div>
                                <div class="user-info" style="flex:1">
                                    <h3 style="margin:0; font-size: 1.1rem; color: var(--text-main);">{{ $fav->question->titre }}</h3>
                                    <span style="font-size: 0.75rem; color: var(--text-muted)">{{ $fav->question->created_at->diffForHumans() }}</span>
                                </div>

{{--                                <form action="{{ route('favoris.destroy', $fav->id) }}" method="POST" style="margin:0">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="btn-remove" title="Supprimer des favoris">--}}
{{--                                        <i class="fa-solid fa-trash-can"></i>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
                            </div>

                            <div class="question-content">
                                <p style="font-size: 0.95rem; line-height: 1.5; color: var(--text-muted); margin-bottom: 1rem;">
                                    {{ Str::limit($fav->question->description, 120) }}
                                </p>
                            </div>

                            <div class="fav-replies-box">
                                <h5 style="margin: 0 0 10px 0; font-size: 0.85rem; color: var(--primary);">
                                    <i class="fa-regular fa-comments"></i> Réponses récentes
                                </h5>

                                @if($fav->question->reponses->count() > 0)
                                    <div class="replies-list">
                                        @foreach($fav->question->reponses as $reply)
                                            <div class="mini-reply">
                                                <span class="reply-author"> {{ $reply->user->fullname ?? 'Utilisateur' }}</span>
                                                <span class="reply-text">Commentaire: {{ $reply->content }}</span>

                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p style="font-size: 0.8rem; color: #94a3b8; font-style: italic;">Aucune réponse.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <div id="postModal" class="modal">
        <div class="modal-content">
            <h2 style="font-weight: 800; margin-top: 0;">Nouvelle question</h2>
            <form action="{{ route('questions') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.2rem;">
                    <label style="display:block; margin-bottom: 8px; font-weight: 600;">Titre</label>
                    <input type="text" name="titre" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:10px; box-sizing:border-box" placeholder="ex: Panne de secteur" required>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display:block; margin-bottom: 8px; font-weight: 600;">Détails</label>
                    <textarea name="description" rows="5" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:10px; box-sizing:border-box" placeholder="Décrivez votre problème..." required></textarea>
                </div>
                <div style="display:flex; gap:12px;">
                    <button type="submit" class="btn-submit">Publier</button>
                    <button type="button" onclick="closeModal()" style="background:#f1f5f9; color:var(--text-main); border:none; padding:14px; border-radius:12px; width:100%; font-weight:700; cursor:pointer;">Annuler</button>
                </div>
            </form>
        </div>
    </div>
@endauth

<script>
    function openModal() { document.getElementById('postModal').style.display = 'block'; }
    function closeModal() { document.getElementById('postModal').style.display = 'none'; }

    window.onclick = function(event) {
        if (event.target.className === 'modal') closeModal();
    }

    function showSection(sectionId) {
        const feed = document.getElementById('questionsFeed');
        const favoris = document.getElementById('favorisSection');
        const title = document.getElementById('pageTitle');

        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));

        if(sectionId === 'favoris') {
            feed.style.display = 'none';
            favoris.style.display = 'block';
            title.innerText = 'Mes Favoris';
            document.getElementById('link-favoris').classList.add('active');
        } else if (sectionId === 'questions') {
            feed.style.display = 'block';
            favoris.style.display = 'none';
            title.innerText = 'Mes Questions';
            document.getElementById('link-questions').classList.add('active');
        } else {
            feed.style.display = 'block';
            favoris.style.display = 'none';
            title.innerText = 'Découvrir';
            document.getElementById('link-discover').classList.add('active');
        }
    }
</script>

</body>
</html>
