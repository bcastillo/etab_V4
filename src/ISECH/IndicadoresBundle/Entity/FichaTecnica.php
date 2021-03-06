<?php

namespace ISECH\IndicadoresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ISECH\IndicadoresBundle\Validator as CustomAssert;

/**
 * ISECH\IndicadoresBundle\Entity\FichaTecnica
 *
 * @ORM\Table(name="ficha_tecnica")
 * @ORM\Entity(repositoryClass="ISECH\IndicadoresBundle\Entity\FichaTecnicaRepository")
 */
class FichaTecnica
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false)
     * @Assert\Length(
     *      min = "3",
     *      max = "150"
     * )
     */
    private $nombre;

    /**
     * @var string $tema
     *
     * @ORM\Column(name="tema", type="text", nullable=false)
     * @Assert\Length(
     *      min = "3",
     *      max = "500"
     * )
     */
    private $tema;

    /**
     * @var string $concepto
     *
     * @ORM\Column(name="concepto", type="text", nullable=true)
     */
    private $concepto;

    /**
     * @var string $unidadMedida
     *
     * @ORM\Column(name="unidad_medida", type="string", length=50, nullable=false)
     */
    private $unidadMedida;

	/**
     * @var string $meta
     *
     * @ORM\Column(name="meta", type="float", scale=2, nullable=true)
     */
    private $meta;
	
    /**
     * @var string $formula
     *
     * @ORM\Column(name="formula", type="string", length=300, nullable=false)
     */
    private $formula;

    /**
     * @var string $observacion
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var string $camposIndicador
     *
     * @ORM\Column(name="campos_indicador", type="text", nullable=true)
     */
    private $camposIndicador;

    /**
     * @var integer $confiabilidad
     *
     * @ORM\Column(name="confiabilidad", type="integer", nullable=true)
     *
     * @Assert\Range(
     *      min = "0",
     *      max = "100"
     * )
     */
    private $confiabilidad;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string $esAcumulado
     *
     * @ORM\Column(name="es_acumulado", type="boolean", nullable=true)
     */
    private $esAcumulado;
    
    /**
     * @var string $esPublico
     *
     * @ORM\Column(name="es_publico", type="boolean", nullable=true)
     */    
    private $esPublico;

    /**
     * @var datetime ultimaLectura
     *
     * @ORM\Column(name="ultima_lectura", type="datetime", nullable=true)
     */
    private $ultimaLectura;

    /**
     * @var clasificacionPrivacidad
     *
     * @ORM\ManyToMany(targetEntity="ClasificacionPrivacidad", inversedBy="indicadores")
     * @ORM\OrderBy({"descripcion" = "ASC"})
     */
    private $clasificacionPrivacidad;

    /**
     * @ORM\ManyToMany(targetEntity="ClasificacionTecnica", inversedBy="indicadores")
     **/
    private $clasificacionTecnica;

    /**
     *
     * @var periodo
     *
     * @ORM\ManyToOne(targetEntity="Periodos")
     * @ORM\JoinColumn(name="id_periodo", referencedColumnName="id")
     * @ORM\OrderBy({"descripcion" = "ASC"})
     **/
    private $periodo;

    /**
    * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="IndicadorAlertas", mappedBy="indicador", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $alertas;

    /**
     * @ORM\ManyToMany(targetEntity="VariableDato", inversedBy="indicadores")
     * @ORM\JoinTable(name="ficha_tecnica_variable_dato",
     *      joinColumns={@ORM\JoinColumn(name="id_ficha_tecnica", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_variable_dato", referencedColumnName="id")}
     *      )
     * @ORM\OrderBy({"nombre" = "ASC"})
     **/
    private $variables;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="indicadores")
     **/
    private $usuarios;
    
    /**
     * @ORM\ManyToMany(targetEntity="Application\Sonata\UserBundle\Entity\Group", mappedBy="indicadores")
     **/
    private $gruposUsuarios;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="favoritos")
     **/
    private $usuariosFavoritos;

    /**
     * @ORM\ManyToMany(targetEntity="Campo")
     * @ORM\JoinTable(name="ficha_tecnica_campo",
     *      joinColumns={@ORM\JoinColumn(name="id_ficha_tecnica", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_campo", referencedColumnName="id")}
     *      )
     **/
    private $campos;

    /**
    * @var \Doctrine\Common\Collections\ArrayCollection
    * @ORM\OneToMany(targetEntity="GrupoIndicadoresIndicador", mappedBy="indicador", cascade={"all"}, orphanRemoval=true)
    */
    private $grupos;

    /**
     * Get id
     *
     * @return integer
     */
	 
	/**
     *
     * @var periodo
     *
     * @ORM\ManyToOne(targetEntity="ClasificacionUso")
     * @ORM\JoinColumn(name="clasificacionUso", referencedColumnName="id")
     * @ORM\OrderBy({"descripcion" = "ASC"})
     **/
    private $clasificacionUso;
	
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param  string       $nombre
     * @return FichaTecnica
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set tema
     *
     * @param  string       $tema
     * @return FichaTecnica
     */
    public function setTema($tema)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return string
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set concepto
     *
     * @param  string       $concepto
     * @return FichaTecnica
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return string
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set unidadMedida
     *
     * @param  string       $unidadMedida
     * @return FichaTecnica
     */
    public function setUnidadMedida($unidadMedida)
    {
        $this->unidadMedida = $unidadMedida;

        return $this;
    }

    /**
     * Get unidadMedida
     *
     * @return string
     */
    public function getUnidadMedida()
    {
        return $this->unidadMedida;
    }

	/**
     * Set meta
     *
     * @param  string       $meta
     * @return FichaTecnica
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get formula
     *
     * @return string
     */
    public function getMeta()
    {
        return $this->meta;
    }
	
    /**
     * Set formula
     *
     * @param  string       $formula
     * @return FichaTecnica
     */
    public function setFormula($formula)
    {
        $this->formula = $formula;

        return $this;
    }

    /**
     * Get formula
     *
     * @return string
     */
    public function getFormula()
    {
        return $this->formula;
    }

    /**
     * Set observacion
     *
     * @param  string       $observacion
     * @return FichaTecnica
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set confiabilidad
     *
     * @param  integer      $confiabilidad
     * @return FichaTecnica
     */
    public function setConfiabilidad($confiabilidad)
    {
        $this->confiabilidad = $confiabilidad;

        return $this;
    }

    /**
     * Get confiabilidad
     *
     * @return integer
     */
    public function getConfiabilidad()
    {
        return $this->confiabilidad;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->periodos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->variables = new \Doctrine\Common\Collections\ArrayCollection();
		$this->clasificacionUso = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add campos
     *
     * @param  ISECH\IndicadoresBundle\Entity\Campo $campos
     * @return FichaTecnica
     */
    public function addCampo(\ISECH\IndicadoresBundle\Entity\Campo $campos)
    {
        $this->campos[] = $campos;

        return $this;
    }

    /**
     * Remove campos
     *
     * @param ISECH\IndicadoresBundle\Entity\Campo $campos
     */
    public function removeCampo(\ISECH\IndicadoresBundle\Entity\Campo $campos)
    {
        $this->campos->removeElement($campos);
    }

    /**
     * Get campos
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getCampos()
    {
        return $this->campos;
    }

    /**
     * Set id
     *
     * @param  integer      $id
     * @return FichaTecnica
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set camposIndicador
     *
     * @param  string       $camposIndicador
     * @return FichaTecnica
     */
    public function setCamposIndicador($camposIndicador)
    {
        $this->camposIndicador = $camposIndicador;

        return $this;
    }

    /**
     * Get camposIndicador
     *
     * @return string
     */
    public function getCamposIndicador()
    {
        return $this->camposIndicador;
    }

    /**
     * Add alertas
     *
     * @param  ISECH\IndicadoresBundle\Entity\IndicadorAlertas $alertas
     * @return FichaTecnica
     */
    public function addAlertas(\ISECH\IndicadoresBundle\Entity\IndicadorAlertas $alertas)
    {
        //$alertas->setIndicador($this);
        $this->addAlerta($alertas);
        //$this->alertas[] = $alertas;

        //return $this;
    }

    /**
     * Get alertas
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getAlertas()
    {
        return $this->alertas;
    }

    public function __toString()
    {
        return $this->nombre ? :'';
    }

    /**
     * Add alertas
     *
     * @param  ISECH\IndicadoresBundle\Entity\IndicadorAlertas $alertas
     * @return FichaTecnica
     */
    public function addAlerta(\ISECH\IndicadoresBundle\Entity\IndicadorAlertas $alertas)
    {
        $this->alertas[] = $alertas;

        return $this;
    }

    /**
     * Remove alertas
     *
     * @param ISECH\IndicadoresBundle\Entity\IndicadorAlertas $alertas
     */
    public function removeAlerta(\ISECH\IndicadoresBundle\Entity\IndicadorAlertas $alertas)
    {
        $this->alertas->removeElement($alertas);
    }

    public function removeAlertas()
    {
        $this->alertas=array();
    }

    /**
     * Set updatedAt
     *
     * @param  \DateTime    $updatedAt
     * @return FichaTecnica
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add variables
     *
     * @param  \ISECH\IndicadoresBundle\Entity\VariableDato $variables
     * @return FichaTecnica
     */
    public function addVariable(\ISECH\IndicadoresBundle\Entity\VariableDato $variables)
    {
        $this->variables[] = $variables;

        return $this;
    }

    /**
     * Remove variables
     *
     * @param \ISECH\IndicadoresBundle\Entity\VariableDato $variables
     */
    public function removeVariable(\ISECH\IndicadoresBundle\Entity\VariableDato $variables)
    {
        $this->variables->removeElement($variables);
    }

    /**
     * Get variables
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Set ultimaLectura
     *
     * @param  \DateTime    $ultimaLectura
     * @return FichaTecnica
     */
    public function setUltimaLectura($ultimaLectura)
    {
        $this->ultimaLectura = $ultimaLectura;

        return $this;
    }

    /**
     * Get ultimaLectura
     *
     * @return \DateTime
     */
    public function getUltimaLectura()
    {
        return $this->ultimaLectura;
    }

    /**
     * Set periodo
     *
     * @param  \ISECH\IndicadoresBundle\Entity\Periodos $periodo
     * @return FichaTecnica
     */
    public function setPeriodo(\ISECH\IndicadoresBundle\Entity\Periodos $periodo = null)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return \ISECH\IndicadoresBundle\Entity\Periodos
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }
	
	/**
     * Set clasificacionUso
     *
     * @param  \ISECH\IndicadoresBundle\Entity\ClasificacionUso $clasificacionUso
     * @return FichaTecnica
     */
    public function setClasificacionUso(\ISECH\IndicadoresBundle\Entity\ClasificacionUso $clasificacionUso = null)
    {
        $this->clasificacionUso = $clasificacionUso;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return \ISECH\IndicadoresBundle\Entity\ClasificacionUso
     */
    public function getClasificacionUso()
    {
        return $this->clasificacionUso;
    }


    /**
     * Add usuariosFavoritos
     *
     * @param  \ISECH\IndicadoresBundle\Entity\User $usuariosFavoritos
     * @return FichaTecnica
     */
    public function addUsuariosFavorito(\ISECH\IndicadoresBundle\Entity\User $usuariosFavoritos)
    {
        $this->usuariosFavoritos[] = $usuariosFavoritos;

        return $this;
    }

    /**
     * Remove usuariosFavoritos
     *
     * @param \ISECH\IndicadoresBundle\Entity\User $usuariosFavoritos
     */
    public function removeUsuariosFavorito(\ISECH\IndicadoresBundle\Entity\User $usuariosFavoritos)
    {
        $this->usuariosFavoritos->removeElement($usuariosFavoritos);
    }

    /**
     * Get usuariosFavoritos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuariosFavoritos()
    {
        return $this->usuariosFavoritos;
    }

    /**
     * Set esAcumulado
     *
     * @param  boolean      $esAcumulado
     * @return FichaTecnica
     */
    public function setEsAcumulado($esAcumulado)
    {
        $this->esAcumulado = $esAcumulado;

        return $this;
    }

    /**
     * Get esAcumulado
     *
     * @return boolean
     */
    public function getEsAcumulado()
    {
        return $this->esAcumulado;
    }
    
    /**
     * Set esPublico
     *
     * @param boolean $esPublico
     * @return FichaTecnica
     */
    public function setEsPublico($esPublico)
    {
        $this->esPublico = $esPublico;
    
        return $this;
    }

    /**
     *  Get esPublico
     *
     * @return boolean 
     */
    public function getEsPublico()
    {
        return $this->esPublico;
    }

    /**
     * Add grupos
     *
     * @param  \ISECH\IndicadoresBundle\Entity\GrupoIndicadoresIndicador $grupos
     * @return FichaTecnica
     */
    public function addGrupo(\ISECH\IndicadoresBundle\Entity\GrupoIndicadoresIndicador $grupos)
    {
        $this->grupos[] = $grupos;

        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \ISECH\IndicadoresBundle\Entity\GrupoIndicadoresIndicador $grupos
     */
    public function removeGrupo(\ISECH\IndicadoresBundle\Entity\GrupoIndicadoresIndicador $grupos)
    {
        $this->grupos->removeElement($grupos);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * Add clasificacionTecnica
     *
     * @param  \ISECH\IndicadoresBundle\Entity\ClasificacionTecnica $clasificacionTecnica
     * @return FichaTecnica
     */
    public function addClasificacionTecnica(\ISECH\IndicadoresBundle\Entity\ClasificacionTecnica $clasificacionTecnica)
    {
        $this->clasificacionTecnica[] = $clasificacionTecnica;

        return $this;
    }

    /**
     * Remove clasificacionTecnica
     *
     * @param \ISECH\IndicadoresBundle\Entity\ClasificacionTecnica $clasificacionTecnica
     */
    public function removeClasificacionTecnica(\ISECH\IndicadoresBundle\Entity\ClasificacionTecnica $clasificacionTecnica)
    {
        $this->clasificacionTecnica->removeElement($clasificacionTecnica);
    }

    /**
     * Get clasificacionTecnica
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClasificacionTecnica()
    {
        return $this->clasificacionTecnica;
    }

    /**
     * Get clasificacionTecnica
     *
     * @return \ISECH\IndicadoresBundle\Entity\ClasificacionTecnica $clasificacionTecnica
     */
    public function setClasificacionTecnica(\Doctrine\Common\Collections\Collection $clasificacionTecnica)
    {
        foreach ($clasificacionTecnica as $c) {
            $this->addClasificacionTecnica($c);
        }
    }

    /**
     * Add clasificacionPrivacidad
     *
     * @param  \ISECH\IndicadoresBundle\Entity\ClasificacionPrivacidad $clasificacionPrivacidad
     * @return FichaTecnica
     */
    public function addClasificacionPrivacidad(\ISECH\IndicadoresBundle\Entity\ClasificacionPrivacidad $clasificacionPrivacidad)
    {
        $this->clasificacionPrivacidad[] = $clasificacionPrivacidad;

        return $this;
    }

    /**
     * Remove clasificacionPrivacidad
     *
     * @param \ISECH\IndicadoresBundle\Entity\ClasificacionPrivacidad $clasificacionPrivacidad
     */
    public function removeClasificacionPrivacidad(\ISECH\IndicadoresBundle\Entity\ClasificacionPrivacidad $clasificacionPrivacidad)
    {
        $this->clasificacionPrivacidad->removeElement($clasificacionPrivacidad);
    }

    /**
     * Get clasificacionPrivacidad
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClasificacionPrivacidad()
    {
        return $this->clasificacionPrivacidad;
    }

    /**
     * Add usuarios
     *
     * @param  \ISECH\IndicadoresBundle\Entity\User $usuarios
     * @return FichaTecnica
     */
    public function addUsuario(\ISECH\IndicadoresBundle\Entity\User $usuarios)
    {
        $this->usuarios[] = $usuarios;

        return $this;
    }

    /**
     * Remove usuarios
     *
     * @param \ISECH\IndicadoresBundle\Entity\User $usuarios
     */
    public function removeUsuario(\ISECH\IndicadoresBundle\Entity\User $usuarios)
    {
        $this->usuarios->removeElement($usuarios);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add gruposUsuarios
     *
     * @param \Application\Sonata\UserBundle\Entity\Group $gruposUsuarios
     * @return FichaTecnica
     */
    public function addGruposUsuario(\Application\Sonata\UserBundle\Entity\Group $gruposUsuarios)
    {
        $this->gruposUsuarios[] = $gruposUsuarios;
    
        return $this;
    }

    /**
     * Remove gruposUsuarios
     *
     * @param \Application\Sonata\UserBundle\Entity\Group $gruposUsuarios
     */
    public function removeGruposUsuario(\Application\Sonata\UserBundle\Entity\Group $gruposUsuarios)
    {
        $this->gruposUsuarios->removeElement($gruposUsuarios);
    }

    /**
     * Get gruposUsuarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGruposUsuarios()
    {
        return $this->gruposUsuarios;
    }
}
