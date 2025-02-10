extends CharacterBody3D

@export var speed: float = 2.5  # Vitesse de déplacement
@export var rotation_speed: float = 3.0  # Vitesse de rotation

func _physics_process(delta):
	var direction = Vector3.ZERO
	
	# Vérifier les entrées clavier
	if Input.is_action_pressed("avancer"):  # Z
		direction.z -= 1
	if Input.is_action_pressed("reculer"):  # S
		direction.z += 1
	if Input.is_action_pressed("gauche"):   # Q
		direction.x -= 1
	if Input.is_action_pressed("droite"):   # D
		direction.x += 1

	# Normaliser la direction pour éviter les déplacements plus rapides en diagonale
	if direction.length() > 0:
		direction = direction.normalized() * speed

		# Calculer la rotation cible
		var target_rotation = Basis().looking_at(-direction, Vector3.UP).get_euler()
		
		# Interpolation pour tourner en douceur
		rotation.y = lerp_angle(rotation.y, target_rotation.y, delta * rotation_speed)
	
	# Appliquer le mouvement avec détection des collisions
	velocity = direction
	move_and_slide()

	# Vérifier les collisions
	for i in range(get_slide_collision_count()):
		var collision = get_slide_collision(i)
		print("Collision avec : ", collision.get_collider())
