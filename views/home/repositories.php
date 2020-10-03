<?php

use system\App;

$title = "Главная"; // название формы
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php");
?>

<div id="page-content">
    <div class="container text-center">

        <h3>Поиск репозиториев</h3>

        <table class="table_sort">
            <thead>
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

            <tr id = 'first'>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td> </td>
                <td> </td>
            </tr>
            <tbody>
            </tbody>
        </table>


    </div>
</div>


<script>


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


    var jqxhr = $.getJSON("https://api.github.com/search/repositories?sort=stars&q=php&order=desc&per_page=50", function () {
        console.log("success");
    })
        .done(function (data) {

            $.each(data.items, function (i, item) {

                let description = item['description'];

                $('.table_sort tr:last').after('<tr>' +
                    ` <td>${i}</td>` +
                    ` <td><a href="${item['html_url']}" target="_blank">${item['full_name']}</a></td>` +
                    ` <td>${truncate(String(description),30)}</td>` +
                    ` <td>${item['language']}</td>` +
                    ` <td>${item['stargazers_count']}</td>` +
                    ` <td>${item['created_at']}</td>` +
                    ` <td>${item['updated_at']}</td>` +
                    '</tr>');
            });
            sort();
            $('#first').remove();
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        });


    function truncate(string, maxLength) {
        return string.substring(0, maxLength);
    }

</script>

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php");
?>
