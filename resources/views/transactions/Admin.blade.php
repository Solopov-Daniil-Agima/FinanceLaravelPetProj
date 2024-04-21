<div class="user-main-panel">
    <div class = "tables-info">
        <div class="user-column income">
            <h2> Доходы </h2>
        </div>

        <div class="user-column balance">
            <h2> Информация о пользователе </h2>
        </div>

        <div class="user-column expenses">
            <h2> Расходы </h2>
        </div>
    </div>

    @foreach ($elems as $elem)
        <div class="main-blocks">
            <div class="user-column income content-center">

                <div class="block-form">
                    <form method="POST" action="{{ route('createTransaction') }}">
                        @csrf
                        <label for="sum">Укажите сумму, которую хотите добавить</label>
                        <input type="text" id="sum" name="sum" required>
                        <input type="hidden" name="type" value="plus">
                        <input type="hidden" name="user_id" value="{{$elem['user_id']}}">
                        <button type="submit">Добавить</button>
                    </form>
                </div>

                @foreach($elem['transactions_plus'] as $plus)
                    <div class="transaction-info">
                        <div class="transaction-elem">Номер транзакции: {{$plus['id']}}</div>
                        <div class="transaction-elem">Сумма: {{$plus['sum']}}</div>
                        <div class="transaction-elem">Дата создания: {{date("Y-m-d", strtotime($plus['created_at']))}}</div>
                    </div>
                @endforeach
            </div>
            <div class="user-column balance">
                <div class="block">
                    <div class="user-info">
                        Имя пользователя: {{$elem['name']}}
                    </div>
                    <div class="user-info">
                        Почта пользователя: {{$elem['email']}}
                    </div>
                    <div class="user-info">
                        <h2>Баланс пользователя: {{$elem['balance']}}</h2>
                    </div>
                </div>
            </div>
            <div class="user-column expenses">
                <div class="block-form">
                    <form method="POST" action="{{ route('createTransaction') }}">
                        @csrf
                        <label for="sum">Укажите сумму, которую хотите добавить</label>
                        <input type="text" id="sum" name="sum" required>
                        <input type="hidden" name="type" value="minus">
                        <input type="hidden" name="user_id" value="{{$elem['user_id']}}">
                        <button type="submit">Добавить</button>
                    </form>
                </div>

                @foreach($elem['transactions_minus'] as $minus)
                    <div class="transaction-info">
                        <div class="transaction-elem">Номер транзакции: {{$minus['id']}}</div>
                        <div class="transaction-elem">Сумма: {{$minus['sum']}}</div>
                        <div class="transaction-elem">Дата создания: {{date("Y-m-d", strtotime($minus['created_at']))}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<style>

    .main-blocks {
        border-bottom: 2px solid #000;
        border-padding: 5px;
    }

    .transaction-info {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
    }

    .tables-info{
        display: flex;
        flex-direction: row;
        border-bottom: 2px solid #000;
        border-padding: 5px;
    }

    .user-column {
        display:block;
        width: 100%;
    }

    .main-blocks {
        display: flex;
        flex-direction: row;
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

    .balance {
        background-color: #f1ef6f;
        display: flex;
        justify-content: center;
        align-items: center;
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

