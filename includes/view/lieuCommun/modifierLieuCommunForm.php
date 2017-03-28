 <?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	
	if (!auth())
		exit();

	if(isset($_POST['id']))
	{
		$lc=new LieuCommun($_POST["id"]);
		$horaires=unserialize($lc->getHeureReservable());
?>
		<div class="col-lg-6" style="width:100%;" name="form-camping" id="form-camping">
			<span class="pull-left">Modification du lieu  </span><br/>
			<form role="form" method="post" enctype="multipart/form-data" name="form-lc" id="form-lc">
				<div class="form-group">
					<label for="nom">Entrez le nom du lieu</label><br/>
					<input class="form-control" type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($lc->getNom()); ?>"/> <br />
					<label for="nom">Description du lieu</label><br/>
					<textarea class="form-control" rows="6" cols="30" type="text" name="description" id="description"><?php echo htmlspecialchars($lc->getDescription()); ?></textarea> <br />
					<label for="horaires_bool">Le lieu commun est-il réservable ?</label>
					<input type="checkbox" value="true" name="estReservable" id="estReservable" onclick="$('#horaires_div').toggle();" <?php if ($lc-getEstReservable()) { echo 'checked'; } ?>/><br/>
					<div id="horaires_div" name="horaires_div" <?php if (!$lc-getEstReservable()) { echo 'style="display:none;'; } ?>>
						<label for="horaires">Horaires d'ouvertures</label><br/>
						<span> Lundi <input type="checkbox" onclick="$('#lundi_horaires').toggle();" <?php if ($horaires[1]) echo "checked"; ?> /> Ouvert ?</span><br/>
						<div id="lundi_horaires" <?php if (!$horaires[1]) echo 'style="display:none;"'; ?>>
							<?php
								$j=1;
								if ($horaires[1])
								{
									$i=0;
									while($i<48)
									{
										while (!$horaires[1][$i] && $i<48)
										{
											$i++;
										}
										if ($i==0 && $horaires[1][47])
										{
											while ($horaires[1][$i] && $i<48)
											{
												$i++;
											}
											$seconde_horaire=$i-1;
											$i=47;
											while ($horaires[1][$i] && $i>0)
											{
												$i--;
											}
											$first_horaire=$i+1;
											?>
											<input type="text" name="horaire_open_lundi_<?php echo $j ?>" id="horaire_open_lundi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($first_horaire/2)<10) echo 0; echo floor($first_horaire/2); echo ":"; if ($first_horaire%2==1) echo 30; ?>" />
											<input type="text" name="horaire_close_lundi_<?php echo $j ?>" id="horaire_close_lundi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" />
											<?php
											$j++;
										}
										else
										{
											if ($i<48)
											{
												$first_horaire=$i;
												if ($i==47 || $horaires[1][$i+1])
												{
													if ($i!=47)
													{
														while ($horaires[1][$i] && $i<48)
														{
															$i++;
														}
													}
													if (($i==48 || $i==47) && $horaires[1][0])
													{
														$i=0;
														while ($horaires[1][$i] && $i<48)
														{
															$i++;
														}
													}
													$i--;
													$seconde_horaire=$i;
												}
												else
												{
													
												}
												?>
												<input type="text" name="horaire_open_lundi_<?php echo $j ?>" id="horaire_open_lundi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($i/2)<10) echo 0; echo floor($i/2); echo ":"; if ($i%2==1) echo 30; ?>" />
												<input type="text" name="horaire_close_lundi_<?php echo $j ?>" id="horaire_close_lundi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" /> 
												<?php
												$j++;
											}
										}
										$i++;
									}
								}
								else
								{
									?>
									<input type="text" name="horaire_open_lundi_1" id="horaire_open_lundi_1" placeholder="Heure d'ouverture" />
									<input type="text" name="horaire_close_lundi_1" id="horaire_close_lundi_1" placeholder="Heure de fermeture" /> 
									<?php
								}
							?>
							<img src="unknow" alt="+" onclick="addHoraires('lundi');" id="button_plus_lundi" name="button_plus_lundi" /><br/>
						</div>
						<span> Mardi <input type="checkbox" onclick="$('#mardi_horaires').toggle();" <?php if ($horaires[2]) echo "checked"; ?> /> Ouvert ?</span><br/>
						<div id="mardi_horaires" <?php if (!$horaires[2]) echo 'style="display:none;"'; ?>>
							<?php
								$j=1;
								if ($horaires[2])
								{
									$i=0;
									while($i<48)
									{
										while (!$horaires[2][$i] && $i<48)
										{
											$i++;
										}
										if ($i==0 && $horaires[2][47])
										{
											while ($horaires[2][$i] && $i<48)
											{
												$i++;
											}
											$seconde_horaire=$i-1;
											$i=47;
											while ($horaires[2][$i] && $i>0)
											{
												$i--;
											}
											$first_horaire=$i+1;
											?>
											<input type="text" name="horaire_open_mardi_<?php echo $j ?>" id="horaire_open_mardi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($first_horaire/2)<10) echo 0; echo floor($first_horaire/2); echo ":"; if ($first_horaire%2==1) echo 30; ?>" />
											<input type="text" name="horaire_close_mardi_<?php echo $j ?>" id="horaire_close_mardi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" />
											<?php
											$j++;
										}
										else
										{
											if ($i<48)
											{
												$first_horaire=$i;
												if ($i==47 || $horaires[2][$i+1])
												{
													if ($i!=47)
													{
														while ($horaires[2][$i] && $i<48)
														{
															$i++;
														}
													}
													if (($i==48 || $i==47) && $horaires[2][0])
													{
														$i=0;
														while ($horaires[2][$i] && $i<48)
														{
															$i++;
														}
													}
													$i--;
													$seconde_horaire=$i;
												}
												else
												{
													
												}
												?>
												<input type="text" name="horaire_open_mardi_<?php echo $j ?>" id="horaire_open_mardi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($i/2)<10) echo 0; echo floor($i/2); echo ":"; if ($i%2==1) echo 30; ?>" />
												<input type="text" name="horaire_close_mardi_<?php echo $j ?>" id="horaire_close_mardi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" /> 
												<?php
												$j++;
											}
										}
										$i++;
									}
								}
								else
								{
									?>
									<input type="text" name="horaire_open_mardi_1" id="horaire_open_mardi_1" placeholder="Heure d'ouverture" />
							<input type="text" name="horaire_close_mardi_1" id="horaire_close_mardi_1" placeholder="Heure de fermeture" /> 
									<?php
								}
							?>
							<img src="unknow" alt="+" onclick="addHoraires('mardi');" id="button_plus_mardi" name="button_plus_mardi" /><br/>
						</div>
						<span> Mercredi <input type="checkbox" onclick="$('#mercredi_horaires').toggle();" <?php if ($horaires[3]) echo "checked"; ?> /> Ouvert ?</span><br/>
						<div id="mercredi_horaires" <?php if (!$horaires[3]) echo 'style="display:none;"'; ?>>
							<?php
								$j=1;
								if ($horaires[3])
								{
									$i=0;
									while($i<48)
									{
										while (!$horaires[3][$i] && $i<48)
										{
											$i++;
										}
										if ($i==0 && $horaires[3][47])
										{
											while ($horaires[3][$i] && $i<48)
											{
												$i++;
											}
											$seconde_horaire=$i-1;
											$i=47;
											while ($horaires[3][$i] && $i>0)
											{
												$i--;
											}
											$first_horaire=$i+1;
											?>
											<input type="text" name="horaire_open_mercredi_<?php echo $j ?>" id="horaire_open_mercredi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($first_horaire/2)<10) echo 0; echo floor($first_horaire/2); echo ":"; if ($first_horaire%2==1) echo 30; ?>" />
											<input type="text" name="horaire_close_mercredi_<?php echo $j ?>" id="horaire_close_mercredi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" />
											<?php
											$j++;
										}
										else
										{
											if ($i<48)
											{
												$first_horaire=$i;
												if ($i==47 || $horaires[3][$i+1])
												{
													if ($i!=47)
													{
														while ($horaires[3][$i] && $i<48)
														{
															$i++;
														}
													}
													if (($i==48 || $i==47) && $horaires[3][0])
													{
														$i=0;
														while ($horaires[3][$i] && $i<48)
														{
															$i++;
														}
													}
													$i--;
													$seconde_horaire=$i;
												}
												else
												{
													
												}
												?>
												<input type="text" name="horaire_open_mercredi_<?php echo $j ?>" id="horaire_open_mercredi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($i/2)<10) echo 0; echo floor($i/2); echo ":"; if ($i%2==1) echo 30; ?>" />
												<input type="text" name="horaire_close_mercredi_<?php echo $j ?>" id="horaire_close_mercredi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" /> 
												<?php
												$j++;
											}
										}
										$i++;
									}
								}
								else
								{
									?>
									<input type="text" name="horaire_open_mercredi_1" id="horaire_open_mercredi_1" placeholder="Heure d'ouverture" />
							<input type="text" name="horaire_close_mercredi_1" id="horaire_close_mercredi_1" placeholder="Heure de fermeture" /> 
									<?php
								}
							?>
							<img src="unknow" alt="+" onclick="addHoraires('mercredi');" id="button_plus_mercredi" name="button_plus_mercredi" /><br/>
						</div>
						<span> Jeudi <input type="checkbox" onclick="$('#jeudi_horaires').toggle();" <?php if ($horaires[4]) echo "checked"; ?> /> Ouvert ?</span><br/>
						<div id="jeudi_horaires" <?php if (!$horaires[4]) echo 'style="display:none;"'; ?>>
							<?php
								$j=1;
								if ($horaires[4])
								{
									$i=0;
									while($i<48)
									{
										while (!$horaires[4][$i] && $i<48)
										{
											$i++;
										}
										if ($i==0 && $horaires[4][47])
										{
											while ($horaires[4][$i] && $i<48)
											{
												$i++;
											}
											$seconde_horaire=$i-1;
											$i=47;
											while ($horaires[4][$i] && $i>0)
											{
												$i--;
											}
											$first_horaire=$i+1;
											?>
											<input type="text" name="horaire_open_jeudi_<?php echo $j ?>" id="horaire_open_jeudi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($first_horaire/2)<10) echo 0; echo floor($first_horaire/2); echo ":"; if ($first_horaire%2==1) echo 30; ?>" />
											<input type="text" name="horaire_close_jeudi_<?php echo $j ?>" id="horaire_close_jeudi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" />
											<?php
											$j++;
										}
										else
										{
											if ($i<48)
											{
												$first_horaire=$i;
												if ($i==47 || $horaires[4][$i+1])
												{
													if ($i!=47)
													{
														while ($horaires[4][$i] && $i<48)
														{
															$i++;
														}
													}
													if (($i==48 || $i==47) && $horaires[4][0])
													{
														$i=0;
														while ($horaires[4][$i] && $i<48)
														{
															$i++;
														}
													}
													$i--;
													$seconde_horaire=$i;
												}
												else
												{
													
												}
												?>
												<input type="text" name="horaire_open_jeudi_<?php echo $j ?>" id="horaire_open_jeudi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($i/2)<10) echo 0; echo floor($i/2); echo ":"; if ($i%2==1) echo 30; ?>" />
												<input type="text" name="horaire_close_jeudi_<?php echo $j ?>" id="horaire_close_jeudi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" /> 
												<?php
												$j++;
											}
										}
										$i++;
									}
								}
								else
								{
									?>
									<input type="text" name="horaire_open_jeudi_1" id="horaire_open_jeudi_1" placeholder="Heure d'ouverture" />
							<input type="text" name="horaire_close_jeudi_1" id="horaire_close_jeudi_1" placeholder="Heure de fermeture" /> 
									<?php
								}
							?>
							<img src="unknow" alt="+" onclick="addHoraires('jeudi');" id="button_plus_jeudi" name="button_plus_jeudi" /><br/>
						</div>
						<span> Vendredi <input type="checkbox" onclick="$('#vendredi_horaires').toggle();" <?php if ($horaires[5]) echo "checked"; ?> /> Ouvert ?</span><br/>
						<div id="vendredi_horaires" <?php if (!$horaires[5]) echo 'style="display:none;"'; ?>>
							<?php
								$j=1;
								if ($horaires[5])
								{
									$i=0;
									while($i<48)
									{
										while (!$horaires[5][$i] && $i<48)
										{
											$i++;
										}
										if ($i==0 && $horaires[5][47])
										{
											while ($horaires[5][$i] && $i<48)
											{
												$i++;
											}
											$seconde_horaire=$i-1;
											$i=47;
											while ($horaires[5][$i] && $i>0)
											{
												$i--;
											}
											$first_horaire=$i+1;
											?>
											<input type="text" name="horaire_open_vendredi_<?php echo $j ?>" id="horaire_open_vendredi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($first_horaire/2)<10) echo 0; echo floor($first_horaire/2); echo ":"; if ($first_horaire%2==1) echo 30; ?>" />
											<input type="text" name="horaire_close_vendredi_<?php echo $j ?>" id="horaire_close_vendredi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" />
											<?php
											$j++;
										}
										else
										{
											if ($i<48)
											{
												$first_horaire=$i;
												if ($i==47 || $horaires[5][$i+1])
												{
													if ($i!=47)
													{
														while ($horaires[5][$i] && $i<48)
														{
															$i++;
														}
													}
													if (($i==48 || $i==47) && $horaires[5][0])
													{
														$i=0;
														while ($horaires[5][$i] && $i<48)
														{
															$i++;
														}
													}
													$i--;
													$seconde_horaire=$i;
												}
												else
												{
													
												}
												?>
												<input type="text" name="horaire_open_vendredi_<?php echo $j ?>" id="horaire_open_vendredi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($i/2)<10) echo 0; echo floor($i/2); echo ":"; if ($i%2==1) echo 30; ?>" />
												<input type="text" name="horaire_close_vendredi_<?php echo $j ?>" id="horaire_close_vendredi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" /> 
												<?php
												$j++;
											}
										}
										$i++;
									}
								}
								else
								{
									?>
									<input type="text" name="horaire_open_vendredi_1" id="horaire_open_vendredi_1" placeholder="Heure d'ouverture" />
									<input type="text" name="horaire_close_vendredi_1" id="horaire_close_vendredi_1" placeholder="Heure de fermeture" /> 
									<?php
								}
							?>
							<img src="unknow" alt="+" onclick="addHoraires('vendredi');" id="button_plus_vendredi" name="button_plus_vendredi" /><br/>
						</div>
						<span> Samedi <input type="checkbox" onclick="$('#samedi_horaires').toggle();" <?php if ($horaires[6]) echo "checked"; ?> /> Ouvert ?</span><br/>
						<div id="samedi_horaires" <?php if (!$horaires[6]) echo 'style="display:none;"'; ?>>
							<?php
								$j=1;
								if ($horaires[6])
								{
									$i=0;
									while($i<48)
									{
										while (!$horaires[6][$i] && $i<48)
										{
											$i++;
										}
										if ($i==0 && $horaires[6][47])
										{
											while ($horaires[6][$i] && $i<48)
											{
												$i++;
											}
											$seconde_horaire=$i-1;
											$i=47;
											while ($horaires[6][$i] && $i>0)
											{
												$i--;
											}
											$first_horaire=$i+1;
											?>
											<input type="text" name="horaire_open_samedi_<?php echo $j ?>" id="horaire_open_samedi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($first_horaire/2)<10) echo 0; echo floor($first_horaire/2); echo ":"; if ($first_horaire%2==1) echo 30; ?>" />
											<input type="text" name="horaire_close_samedi_<?php echo $j ?>" id="horaire_close_samedi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" />
											<?php
											$j++;
										}
										else
										{
											if ($i<48)
											{
												$first_horaire=$i;
												if ($i==47 || $horaires[6][$i+1])
												{
													if ($i!=47)
													{
														while ($horaires[6][$i] && $i<48)
														{
															$i++;
														}
													}
													if (($i==48 || $i==47) && $horaires[6][0])
													{
														$i=0;
														while ($horaires[6][$i] && $i<48)
														{
															$i++;
														}
													}
													$i--;
													$seconde_horaire=$i;
												}
												else
												{
													
												}
												?>
												<input type="text" name="horaire_open_samedi_<?php echo $j ?>" id="horaire_open_samedi_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($i/2)<10) echo 0; echo floor($i/2); echo ":"; if ($i%2==1) echo 30; ?>" />
												<input type="text" name="horaire_close_samedi_<?php echo $j ?>" id="horaire_close_samedi_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" /> 
												<?php
												$j++;
											}
										}
										$i++;
									}
								}
								else
								{
									?>
									<input type="text" name="horaire_open_samedi_1" id="horaire_open_samedi_1" placeholder="Heure d'ouverture" />
									<input type="text" name="horaire_close_samedi_1" id="horaire_close_samedi_1" placeholder="Heure de fermeture" /> 
									<?php
								}
							?>
							<img src="unknow" alt="+" onclick="addHoraires('samedi');" id="button_plus_samedi" name="button_plus_samedi" /><br/>
						</div>
						<span> Dimanche <input type="checkbox" onclick="$('#dimanche_horaires').toggle();"<?php if ($horaires[0]) echo "checked"; ?> /> Ouvert ?</span><br/>
						<div id="dimanche_horaires" <?php if (!$horaires[0]) echo 'style="display:none;"'; ?>>
							<?php
								$j=1;
								if ($horaires[0])
								{
									$i=0;
									while($i<48)
									{
										while (!$horaires[0][$i] && $i<48)
										{
											$i++;
										}
										if ($i==0 && $horaires[0][47])
										{
											while ($horaires[0][$i] && $i<48)
											{
												$i++;
											}
											$seconde_horaire=$i-1;
											$i=47;
											while ($horaires[0][$i] && $i>0)
											{
												$i--;
											}
											$first_horaire=$i+1;
											?>
											<input type="text" name="horaire_open_dimanche_<?php echo $j ?>" id="horaire_open_dimanche_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($first_horaire/2)<10) echo 0; echo floor($first_horaire/2); echo ":"; if ($first_horaire%2==1) echo 30; ?>" />
											<input type="text" name="horaire_close_dimanche_<?php echo $j ?>" id="horaire_close_dimanche_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" />
											<?php
											$j++;
										}
										else
										{
											if ($i<48)
											{
												$first_horaire=$i;
												if ($i==47 || $horaires[0][$i+1])
												{
													if ($i!=47)
													{
														while ($horaires[0][$i] && $i<48)
														{
															$i++;
														}
													}
													if (($i==48 || $i==47) && $horaires[0][0])
													{
														$i=0;
														while ($horaires[0][$i] && $i<48)
														{
															$i++;
														}
													}
													$i--;
													$seconde_horaire=$i;
												}
												else
												{
													
												}
												?>
												<input type="text" name="horaire_open_dimanche_<?php echo $j ?>" id="horaire_open_dimanche_<?php echo $j ?>" placeholder="Heure d'ouverture" value="<?php if (floor($i/2)<10) echo 0; echo floor($i/2); echo ":"; if ($i%2==1) echo 30; ?>" />
												<input type="text" name="horaire_close_dimanche_<?php echo $j ?>" id="horaire_close_dimanche_<?php echo $j ?>" placeholder="Heure de fermeture" value="<?php if (floor($seconde_horaire/2)<10) echo 0; echo floor($seconde_horaire/2); echo ":"; if ($seconde_horaire%2==1) echo 30; ?>" /> 
												<?php
												$j++;
											}
										}
										$i++;
									}
								}
								else
								{
									?>
									<input type="text" name="horaire_open_dimanche_1" id="horaire_open_dimanche_1" placeholder="Heure d'ouverture" />
									<input type="text" name="horaire_close_dimanche_1" id="horaire_close_dimanche_1" placeholder="Heure de fermeture" /> 
									<?php
								}
							?>
							<img src="unknow" alt="+" onclick="addHoraires('dimanche');" id="button_plus_dimanche" name="button_plus_dimanche" /><br/>	
						</div>
					</div>
					<label for="imageAjax" onclick="addImage();">Ajouter une photo</label><br/>
					<?php
						$i=0;
						foreach ($lc->getPhotos() as $val)
						{
							if (!empty($val))
							{
								$i++;
								?>
								<script type="text/javascript">
									addImage('<?php echo htmlentities($val); ?>');
								</script>
								<?php
							}
						}
					?>
					<input type="hidden" name="id" id="id" value="<?php echo htmlentities($_POST["id"]); ?>" />
					<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('lieuCommun.controllerForm.php')); ?>', '#form-lc', '#form-camping', 'prepend', true); return false;">Ajouter</button>
				</div>
			</form>
		</div>
		
		
<?php 
	}
	else
	{
		echo 'Aucun lieu reçu pour la modification'; 
	}