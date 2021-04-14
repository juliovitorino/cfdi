<?php


/**
 * 
 */
class TBodyProjetoConcrete extends TBodyFactory
{
	private $dto;
	
	public function __construct($dto)
	{
		$this->dto = $dto;
	}
/*
                                            <tr class="odd gradeX">
                                                <td>
                                                    <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td> importadormestre </td>
                                                <td>
                                                    Importar roupas dos EUA mais barato para poder revender no Brasil bem mais barato
                                                </td>
                                                <td> hotmart </td>
                                                <td>
                                                    <span class="label label-sm label-success"> Approved </span>
                                                </td>
                                                <td class="valigntop">
													<a href="edit_patient.html" class="btn btn-primary btn-xs">
														<i class="fa fa-pencil"></i>
													</a>
													<a href="javascript()" class="btn btn-danger btn-xs">
														<i class="fa fa-trash-o "></i>
													</a>
                                                </td>
                                            </tr>
*/
	public function execute()
	{
		$tbodyconteudo = "";
		$trconteudo1 = '<tr class="odd gradeX">
                                                <td>
                                                    <label class="rt-chkbox rt-chkbox-single rt-chkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td> TBodyProjetoConcrete ';
		$trconteudo2 = ' </td>
                                                <td>
                                                    class TBodyProjetoConcrete extends TBodyFactory
                                                </td>
                                                <td> hotmart </td>
                                                <td>
                                                    <span class="label label-sm label-success"> Approved </span>
                                                </td>
                                                <td class="valigntop">
													<a href="edit_patient.html" class="btn btn-primary btn-xs">
														<i class="fa fa-pencil"></i>
													</a>
													<a href="javascript()" class="btn btn-danger btn-xs">
														<i class="fa fa-trash-o "></i>
													</a>
                                                </td>
                                            </tr>
';

		for ($i=0; $i < 5; $i++) { 
			$tbodyconteudo = $tbodyconteudo.$trconteudo1.$i.$trconteudo2;
		}
		return $tbodyconteudo;
	}

}

?>