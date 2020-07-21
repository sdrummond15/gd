<?php

/**
 * @version		$Id: contact.php 21991 2011-08-18 15:43:40Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	Contact
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class TravelsControllerTravels extends JControllerForm {

    public function pedido() {

        $nome = JRequest::getVar('nome');
        $email = JRequest::getVar('email');
        $carrinho = $_SESSION['carrinho'];

        PHP_email::email_pedido($nome, $email, $carrinho);

        return true;
    }

}

class PHP_email extends PHPMailer {

    public function listaprodutos($carrinho) {
        $total = 0;
        $pedido = '';
        foreach ($carrinho as $id => $qtd) {
            $db = &JFactory::getDBO();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__travels');
            $query->where('id = ' . $id);
            $db->setQuery($query);
            $prod = $db->loadObjectList();


            $preco = $prod[0]->price;
            $subtotal = $qtd * $preco;
            $total += $subtotal;

            $produto = $prod[0]->name;
            $preco = number_format($preco, 2, ',', '.');
            $subtotal = number_format($subtotal, 2, ',', '.');

            $pedido .= '<tr>'
                    . '<td><font size="3" face="Arial" color="#444">' . $produto . '</td>'
                    . '<td align="center"><font size="3" face="Arial" color="#444">' . $qtd . '</td>'
                    . '<td align="center"><font size="3" face="Arial" color="#444">R$ ' . $preco . '</td>'
                    . '<td align="center"><font size="3" face="Arial" color="#444">R$ ' . $subtotal . '</td>'
                    . '</tr>';
        }

        $total = number_format($total, 2, ',', '.');

        $total = '<tr>'
                . '<td colspan = "3" align="right"><font size="3" face="Arial" color="#444"><b>Total</b></td>'
                . '<td align="center"><font size="3" face="Arial" color="#444"><b>R$ ' . $total . '</b></td>'
                . '</tr>';

        $pedido .= $total;

        return $pedido;
    }

    function email_pedido($nome, $email, $carrinho) {

        $app = JFactory::getApplication();
        $mailfrom = 'contato@carvalhopecas.com.br';
        $fromname = 'Or�amento - Carvalho Pe�as';
        $sitename = $app->getCfg('sitename');

        $mail = JFactory::getMailer();
        $mail->addRecipient($mailfrom);
        $mail->setSender(array($mailfrom, $fromname));
        $mail->IsHTML();
        $mail->setSubject("Or�amento de Produtos");
        $mail->setBody(
                '<html>'
                . '<body>'
                . '<table width="55%" align="center" border="1" cellspacing="0">'
                . '<tr>'
                . '<th colspan="4">'
                . '<font size="6" face="Arial" color="#0F0F73">'
                . 'Or�amento'
                . '</font>'
                . '</th>'
                . '</tr>'
                . '<tr>'
                . '<td align="left" colspan = "4">'
                . '<font size="4" face="Arial" color="#444">'
                . '<b>Nome: </b>' . $nome
                . '</td>'
                . '</tr>'
                . '<tr>'
                . '<td align="left" colspan = "4">'
                . '<font size="4" face="Arial" color="#444">'
                . '<b>E-mail: </b>' . $email
                . '</td>'
                . '</tr>'
                . '<tr>'
                . '<td align="center">'
                . '<font size="3" face="Arial" color="#444">'
                . '<b>Produto</b>'
                . '</td>'
                . '<td align="center">'
                . '<font size="3" face="Arial" color="#444">'
                . '<b>Quantidade</b>'
                . '</td>'
                . '<td align="center">'
                . '<font size="3" face="Arial" color="#444">'
                . '<b>Pre�o Unit�tio</b>'
                . '</td>'
                . '<td align="center">'
                . '<font size="3" face="Arial" color="#444">'
                . '<b>Subtotal</b>'
                . '</td>'
                . '</tr>' .
                PHP_email::listaprodutos($carrinho)
                . '</table>'
                . '</body>'
                . '</html>');

        $sent = $mail->Send();

        unset($_SESSION['carrinho']);

        $db = &JFactory::getDBO();
        $app = JFactory::getApplication();
        $menu = $app->getMenu()->getActive()->menutype;
        if ($menu == 'produtos') {
            $menuid = $app->getMenu()->getActive()->id;
        } else {
            $menu = 'produtos';
            $menuid = $app->getMenu()->getActive()->id;
        }

        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__menu');
        $query->where('id =' . $menuid);
        $db->setQuery($query);
        $menu = $db->loadObjectList();

        if (!empty($menu)) {
            $menu = 'index.php/' . $menu[0]->path;
        }

        header('Location: ' . $menu . '?view=travels&layout=default_finalizar&msg=1');
    }

}
