<div class="user-main-panel">
    <h2>Общий баланс пользователя - {{$balance}} руб</h2>

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
                    <div class="transaction-elem">Дата создания: {{date("Y-m-d", strtotime($elem['created_at']))}}</div>
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
                    <div class="transaction-elem">Дата создания: {{date("Y-m-d", strtotime($elem['created_at']))}}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
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
        width: 100%;
        text-align: center;
    }

    .block-form {
        width: 100%;
        text-align: center;
        margin: 10px;
    }
</style>

