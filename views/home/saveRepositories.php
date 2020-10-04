<?php

use system\App;

$title = "Сохраненные репозитории"; // название формы
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php");

?>

<div id="page-content">
    <div class="container text-center">

        <h3>Сохраненные репозитории: <?= App::getUser()['surName'] ?></h3>

        <table class="table_sort">
            <thead id="table_sort_head">
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Язык</th>
                <th>Рейтинг</th>
                <th>Дата обновления</th>
                <th>Дата создания</th>
            </tr>
            </thead>
            <tbody id="table_sort_body">
            </tbody>
        </table>

    </div>
</div>


<script>

    var token = '<?=App::getUserToken()?>';

    $(function () {
        sort();
        getSaveRep();
    });

    function sort() {
        const getSort = ({target}) => {
            const order = (target.dataset.order = -(target.dataset.order || -1));
            const index = [...target.parentNode.cells].indexOf(target);
            const collator = new Intl.Collator(['en', 'ru'], {numeric: true});
            const comparator = (index, order) => (a, b) => order * collator.compare(
                a.children[index].innerHTML,
                b.children[index].innerHTML
            );

            for (const tBody of target.closest('table').tBodies)
                tBody.append(...[...tBody.rows].sort(comparator(index, order)));

            for (const cell of target.parentNode.cells)
                cell.classList.toggle('sorted', cell === target);
        };

        document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
    }

    function getSaveRep() {
        $.ajax({
            url: '/api/user/save',
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Basic ' + btoa(token)
            },
            success: function (data) {
                $('#table_sort_body tr').remove();
                $('#table_sort_head th').removeAttr('data-order');
                $('#table_sort_head th').removeAttr('class');
                $.each(data['items'], function (i, item) {

                    let description = item['description'];

                    $('#table_sort_body').append('<tr>' +
                        ` <td>${i}</td>` +
                        ` <td><a href="${item['htmlUrl']}" target="_blank">${item['fullName']}</a></td>` +
                        ` <td>${truncate(String(description), 30)}</td>` +
                        ` <td>${item['languages']}</td>` +
                        ` <td>${item['stargazersCount']}</td>` +
                        ` <td>${item['created_at']}</td>` +
                        ` <td>${item['updated_at']}</td>` +
                        ` <td><a href="#" onclick="deleteSaveRep(id =${item['id']})">delete</a></td>` +
                        '</tr>');
                });
            },
            error: function (data) {
                console.log(data)
            },
        });
    }

    function deleteSaveRep(id) {

        $.ajax({
            url: '/api/user/save/' + id,
            type: 'DELETE',
            dataType: 'json',
            headers: {
                'Authorization': 'Basic ' + btoa(token)
            },
            success: function (data) {
                if (data == 'ok') {
                    getSaveRep();
                    alert('Удалено');
                }
            },
            error: function (data) {
                console.log(data)
            },
        });

    }

    function truncate(string, maxLength) {
        return string.substring(0, maxLength);
    }

</script>

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php");
?>
