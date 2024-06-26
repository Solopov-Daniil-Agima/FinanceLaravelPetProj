<div class="user-main-panel">
    <h2>Общий баланс пользователя: {{$balance}} руб</h2>

    <div class="excel">
        <h2>Получить в виде Excel таблицы:</h2>

        <form method="POST" action="{{ route('exportExcel') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{$user_id}}">
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 48 48">
                    <path fill="#169154" d="M29,6H15.744C14.781,6,14,6.781,14,7.744v7.259h15V6z"></path><path fill="#18482a" d="M14,33.054v7.202C14,41.219,14.781,42,15.743,42H29v-8.946H14z"></path><path fill="#0c8045" d="M14 15.003H29V24.005000000000003H14z"></path><path fill="#17472a" d="M14 24.005H29V33.055H14z"></path><g><path fill="#29c27f" d="M42.256,6H29v9.003h15V7.744C44,6.781,43.219,6,42.256,6z"></path><path fill="#27663f" d="M29,33.054V42h13.257C43.219,42,44,41.219,44,40.257v-7.202H29z"></path><path fill="#19ac65" d="M29 15.003H44V24.005000000000003H29z"></path><path fill="#129652" d="M29 24.005H44V33.055H29z"></path></g><path fill="#0c7238" d="M22.319,34H5.681C4.753,34,4,33.247,4,32.319V15.681C4,14.753,4.753,14,5.681,14h16.638 C23.247,14,24,14.753,24,15.681v16.638C24,33.247,23.247,34,22.319,34z"></path><path fill="#fff" d="M9.807 19L12.193 19 14.129 22.754 16.175 19 18.404 19 15.333 24 18.474 29 16.123 29 14.013 25.07 11.912 29 9.526 29 12.719 23.982z"></path>
                </svg>
            </button>
        </form>
    </div>

    <div class="main-blocks">
        <div class="user-column income">
            <h2> Доходы </h2>
            <div class="block-form">
                <form method="POST" action="{{ route('createTransaction') }}">
                    @csrf
                    <label for="sum">Укажите сумму, которую хотите добавить</label>
                    <input type="text" id="sum" name="sum" required>
                    <input type="hidden" name="type" value="plus">
                    <input type="hidden" name="user_id" value="{{(Auth::user())->id}}">
                    <button type="submit">Добавить</button>
                </form>
            </div>

            @foreach($transactions_plus as $elem)
                <div class="transaction-info">
                    <div class="transaction-elem">Номер транзакции: {{$elem['id']}}</div>
                    <div class="transaction-elem">Сумма: {{$elem['sum']}}</div>
                    <div class="transaction-elem">Дата создания: {{date("Y-m-d H:i:s", strtotime($elem['created_at']))}}</div>
                </div>
            @endforeach
        </div>
        <div class="user-column expenses">
            <h2> Расходы </h2>
            <div class="block-form">
                <form method="POST" action="{{ route('createTransaction') }}">
                    @csrf
                    <label for="sum">Укажите сумму, которую хотите добавить</label>
                    <input type="text" id="sum" name="sum" required>
                    <input type="hidden" name="type" value="minus">
                    <input type="hidden" name="user_id" value="{{(Auth::user())->id}}">
                    <button type="submit">Добавить</button>
                </form>
            </div>

            @foreach($transactions_minus as $elem)
                <div class="transaction-info">
                    <div class="transaction-elem">Номер транзакции: {{$elem['id']}}</div>
                    <div class="transaction-elem">Сумма: {{$elem['sum']}}</div>
                    <div class="transaction-elem">Дата создания: {{date("Y-m-d H:i:s", strtotime($elem['created_at']))}}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .excel{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .transaction-info {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
    }
    .user-column {
        display:block;
        width: 100%;
    }

    .main-blocks {
        display: flex;
        flex-direction: row;
        width: 100%;
    }

    .transaction-elem {
        border: 2px solid #000;
        border-padding: 5px;
        width: 33%;
        padding:5px;
    }

    .income {
        background-color: #98ec98;
    }
    .expenses {
        background-color: #f58fa0;
    }

    h2 {
        text-align: center;
    }

    .block-form {
        width: 100%;
        text-align: center;
        margin: 10px;
    }
</style>

