<tr>

    <td><a href="/reservation.php?id=<?= $item['id']; ?>"></a></td>
    <td><?= $item['title']; ?></td>
    <td><?= $item['firstname']; ?></td>
    <td><?= (DateTime::createFromFormat('Y-m-d', $item['start_date']))->format('d/m/y'); ?></td>
    <td><?= (DateTime::createFromFormat('Y-m-d', $item['end_date']))->format('d/m/y'); ?></td>
    <td><?= !empty($item['date_return'])?(DateTime::createFromFormat('Y-m-d', $item['date_return'] ))->format('Y-m-d'):""; ?></td>
    <td><?= $item['isClosed']? 1: 0; ?></td>
    <td>
    <?php if(!$item['isClosed']):?>
    <a href="reservations.php?idResa=<?=$item['id'];?>" class="btn btn-sm btn-warning">Rendre</a>
    </td>
    <?php endif ?>
</tr>